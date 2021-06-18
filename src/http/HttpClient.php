<?php
declare(strict_types=1);

namespace Bornfight\ErsteBankClient\http;


use Bornfight\ErsteBankClient\models\paramObjects\ApiUser;
use Bornfight\ErsteBankClient\models\paramObjects\SSLCertificates;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;

class HttpClient
{
    public const BASE_URL = 'https://webapi.developers.erstegroup.com';
    private const TOKEN_ENDPOINT = 'https://webapi.developers.erstegroup.com/api/ebc/sandbox/v1/sandbox-idp';

    private $redirectUri;
    private $apiUser;
    private $dataEndpoint;

    public function __construct(ApiUser $apiUser, string $redirectUri, SSLCertificates $sslCertificates, $dataEndpoint)
    {

        $this->redirectUri = $redirectUri;
        $this->apiUser = $apiUser;
        $this->dataEndpoint = $dataEndpoint;

        $this->client = new Client([
            'base_uri'              => self::BASE_URL,
            RequestOptions::HEADERS => [
                'Content-Type'  => 'application/json',
                'cache-control' => 'no-cache',
            ],
            RequestOptions::CERT    => $sslCertificates->getPemFilePath(),
            RequestOptions::SSL_KEY => $sslCertificates->getKeyFilePath(),
        ]);
    }

    public function getConsent(): ResponseInterface
    {
        return $this->client->post(sprintf('%s/consents', $this->dataEndpoint), [
            RequestOptions::HEADERS => [
                'X-Request-ID'              => Uuid::uuid4()->toString(),
                'psu-ip-address'            => '127.0.0.1',
                'signature'                 => 'test',
                'digest'                    => 'test',
                'tpp-signature-certificate' => 'test',
                'web-api-key'               => $this->apiUser->getWebApiKey(),
            ],
            RequestOptions::JSON    => [
                'access'                   => [
                    'accounts'     => [],
                    'balances'     => [],
                    'transactions' => [],
                ],
                'recurringIndicator'       => false,
                'validUntil'               => '2019-06-30',
                'frequencyPerDay'          => 4,
                'combinedServiceIndicator' => false,
            ],
        ]);
    }

    public function getTokenByAuthCode(string $authCode): ResponseInterface
    {
        $queryParams = [
            'redirect_uri'  => $this->redirectUri,
            'client_id'     => $this->apiUser->getClientId(),
            'client_secret' => $this->apiUser->getClientSecret(),
            'grant_type'    => 'authorization_code',
            'code_verifier' => 'loremipsum',
            'code'          => $authCode,
        ];

        return $this->client->get(sprintf('%s/token', self::TOKEN_ENDPOINT), [
                RequestOptions::QUERY => $queryParams,
            ]
        );
    }

    public function getTokenByRefreshToken(string $refreshToken): ResponseInterface
    {
        $queryParams = [
            'redirect_uri'  => $this->redirectUri,
            'client_id'     => $this->apiUser->getClientId(),
            'client_secret' => $this->apiUser->getClientSecret(),
            'grant_type'    => 'refresh_token',
            'code_verifier' => 'loremipsum',
            'refresh_token' => $refreshToken,
        ];

        return $this->client->get(sprintf('%s/token', self::TOKEN_ENDPOINT), [
                RequestOptions::QUERY => $queryParams,
            ]
        );
    }

    public function getAccounts(string $token, string $consent, array $params): ResponseInterface
    {
        return $this->client->get(sprintf('%s/accounts', $this->dataEndpoint), [
            RequestOptions::HEADERS => [
                'X-Request-ID'  => Uuid::uuid4()->toString(),
                'consent-id'    => $consent,
                'Authorization' => "Bearer {$token}",
                'web-api-key'   => $this->apiUser->getWebApiKey(),
            ],
            RequestOptions::QUERY   => $params,
        ]);
    }

    public function getTransactions
    (
        string $token,
        string $consentId,
        string $accountId,
        array $params
    ): ResponseInterface
    {
        $defaultParams = [
            'bookingStatus' => "both",
        ];
        $params = array_merge($params, $defaultParams);
        return $this->client->get(sprintf('%s/accounts/%s/transactions', $this->dataEndpoint, $accountId), [
            RequestOptions::HEADERS => [
                'X-Request-ID'  => Uuid::uuid4()->toString(),
                'consent-id'    => $consentId,
                'Authorization' => "Bearer {$token}",
                'web-api-key'   => $this->apiUser->getWebApiKey(),
            ],
            RequestOptions::QUERY   => $params,
        ]);
    }
}
