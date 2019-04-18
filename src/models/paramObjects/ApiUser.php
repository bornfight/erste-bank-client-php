<?php
declare(strict_types=1);

namespace Bornfight\ErsteBankClient\models\paramObjects;


class ApiUser
{
    private $webApiKey;
    private $clientId;
    private $clientSecret;

    public function __construct(string $webApiKey, string $clientId, string $clientSecret)
    {
        $this->webApiKey = $webApiKey;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }


    public function getWebApiKey(): string
    {
        return $this->webApiKey;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }
}
