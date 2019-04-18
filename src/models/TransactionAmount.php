<?php
declare(strict_types=1);

namespace Degordian\ErsteBankClient\models;


class TransactionAmount
{
    private $amount;
    private $currency;

    public function __construct(object $data)
    {
        $this->amount = $data->amount;
        $this->currency = $data->currency;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): void
    {
        $this->amount = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

}
