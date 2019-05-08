<?php
declare(strict_types=1);

namespace Bornfight\ErsteBankClient\models\Transaction;


class Account
{
    private $iban;

    public function __construct(object $data)
    {
        $this->iban = $data->iban;
    }

    public function getIban(): string
    {
        return $this->iban;
    }

    public function setIban(string $iban): void
    {
        $this->iban = $iban;
    }

}
