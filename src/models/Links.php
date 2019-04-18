<?php
declare(strict_types=1);

namespace Degordian\ErsteBankClient\models;


class Links
{
    private $scaOAuth;
    private $self;
    private $status;
    private $scaStatus;

    public function __construct(object $linksObject)
    {
        $this->scaOAuth = $linksObject->scaOAuth;
        $this->self = $linksObject->self;
        $this->scaStatus = $linksObject->scaStatus;
        $this->status = $linksObject->status;
    }

    public function getScaOAuth(): ?string
    {
        return $this->scaOAuth;

    }

    public function getSelf(): ?string
    {
        return $this->self;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getScaStatus(): ?string
    {
        return $this->scaStatus;
    }
}
