<?php
declare(strict_types=1);


namespace Bornfight\ErsteBankClient;

use Bornfight\ErsteBankClient\enum\ApiEndpoint;
use Bornfight\ErsteBankClient\http\HttpClient;
use Bornfight\ErsteBankClient\models\Account;
use Bornfight\ErsteBankClient\models\Consent;
use Bornfight\ErsteBankClient\models\paramObjects\ApiUser;
use Bornfight\ErsteBankClient\models\paramObjects\SSLCertificates;
use Bornfight\ErsteBankClient\models\Token;
use Bornfight\ErsteBankClient\models\TransactionResponse;
use Bornfight\ErsteBankClient\models\TransactionType;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ErsteBankClient
{
    private $serializer;
    private $httpClient;
    private $redirectUri;
    private $authCode;
    private $token;
    private $consent;
    private $apiUser;


    public function __construct(
        string $webApiKey,
        string $clientId,
        string $clientSecret,
        string $redirectUri,
        string $pemFilePath,
        string $keyFilePath,
        string $dataEndpoint = ApiEndpoint::AISP
    )
    {
        $this->redirectUri = $redirectUri;

        $this->serializer = new Serializer([new ObjectNormalizer(), new ArrayDenormalizer()], [new JsonEncoder()]);
        $this->apiUser = new ApiUser($webApiKey, $clientId, $clientSecret);

        $this->httpClient = new HttpClient(
            $this->apiUser,
            $redirectUri,
            new SSLCertificates($pemFilePath, $keyFilePath),
            $dataEndpoint
        );
    }

    public function getConsent(): Consent
    {
        $consentResponse = $this->httpClient->getConsent();

        $consent = $this->serializer->deserialize($consentResponse->getBody(), Consent::class, 'json', [
            JsonDecode::ASSOCIATIVE => false,
        ]);

        $this->consent = $consent->getConsentId();

        return $consent;
    }

    public function getAuthPageUrl(string $consentId): string
    {
        $options = [
            'redirect_uri'          => $this->redirectUri,
            'client_id'             => $this->apiUser->getClientId(),
            'response_type'         => 'code',
            'access_type'           => 'offline',
            'state'                 => 'loremipsum',
            'code_challenge'        => 'loremipsum',
            'code_challenge_method' => 'S256',
            'scope'                 => "AIS:{$consentId}",
        ];

        return sprintf(
            '%s/api/ebc/sandbox/v1/sandbox-idp/auth?%s',
            HttpClient::BASE_URL, http_build_query($options));
    }

    public function getTokenByAuthCode(string $authCode): Token
    {
        $this->authCode = $authCode;
        $tokenResponse = $this->httpClient->getTokenByAuthCode($authCode);

        $token = $this->serializer->deserialize($tokenResponse->getBody(), Token::class, 'json');

        $this->token = $token->getAccessToken();

        return $token;
    }

    public function getTokenByRefreshToken(string $refreshToken): Token
    {
        $tokenResponse = $this->httpClient->getTokenByRefreshToken($refreshToken);

        $token = $this->serializer->deserialize($tokenResponse->getBody(), Token::class, 'json');

        $this->token = $token->getAccessToken();

        return $token;
    }

    public function getAccounts(string $token, string $consentId, array $params): array
    {
        $accountsResponse = $this->httpClient->getAccounts($token, $consentId, $params);
        $accountsArray = json_decode($accountsResponse->getBody()->getContents(), true)['accounts'];

        return $this->serializer->deserialize(json_encode($accountsArray), Account::class.'[]', 'json');
    }

    public function getTransactions(string $token, string $consentId, string $accountId, array $params): TransactionType
    {
        $transactionsResponse = $this->httpClient->getTransactions($token, $consentId, $accountId, $params);
        return $this->serializer->deserialize(
            $transactionsResponse->getBody()->getContents(),
            TransactionResponse::class,
            'json',
            [
                JsonDecode::ASSOCIATIVE => false,
            ]
        )->getTransactions();
    }
}
