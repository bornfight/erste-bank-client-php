<?php
declare(strict_types=1);

namespace Degordian\ErsteBankClient\models;


class TransactionResponse
{
    private $transactions;
    private $account;

    public function getAccount(): object
    {
        return $this->account;
    }

    public function setAccount($account): void
    {
        $this->account = $account;
    }

    public function getTransactions(): TransactionType
    {
        return $this->transactions;
    }

    public function setTransactions(object $transactions): void
    {
        $this->transactions = new TransactionType($transactions);
    }
}
