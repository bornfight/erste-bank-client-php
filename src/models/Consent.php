<?php
declare(strict_types=1);

namespace Bornfight\ErsteBankClient\models;


class Consent
{
    private $consentStatus;
    private $consentId;
    private $links;

    public function getConsentStatus(): string
    {
        return $this->consentStatus;
    }

    public function getConsentId(): string
    {
        return $this->consentId;
    }

    public function getLinks(): Links
    {
        return $this->links;
    }

    public function setLinks(object $links): void
    {
        $this->links = new Links($links);
    }

    public function setConsentStatus(string $consentStatus): void
    {
        $this->consentStatus = $consentStatus;
    }

    public function setConsentId(string $consentId): void
    {
        $this->consentId = $consentId;
    }
}
