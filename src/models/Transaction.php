<?php
declare(strict_types=1);

namespace Bornfight\ErsteBankClient\models;


use Bornfight\ErsteBankClient\models\Transaction\Amount;
use Bornfight\ErsteBankClient\models\Transaction\Account;

class Transaction
{
    private $transactionId;
    private $endToEndId;
    private $bookingDate;
    private $valueDate;
    private $creditorName;
    private $debtorName;
    private $remittanceInformationUnstructured;
    private $transactionAmount;
    private $creditorAccount;
    private $debtorAccount;

    public function __construct(object $data)
    {
        $this->transactionId = $data->transactionId;
        $this->bookingDate = $data->bookingDate;
        $this->valueDate = $data->valueDate;
        $this->creditorName = $data->creditorName;
        $this->endToEndId = $data->endToEndId ?? null;
        $this->remittanceInformationUnstructured = $data->remittanceInformationUnstructured;
        $this->transactionAmount = new Amount($data->transactionAmount);
        $this->creditorAccount = new Account($data->creditorAccount);

    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function setTransactionId(string $transactionId): void
    {
        $this->transactionId = $transactionId;
    }

    public function getEndToEndId(): ?string
    {
        return $this->endToEndId;
    }

    public function setEndToEndId(?string $endToEndId): void
    {
        $this->endToEndId = $endToEndId;
    }

    public function getBookingDate(): string
    {
        return $this->bookingDate;
    }

    public function setBookingDate(string $bookingDate): void
    {
        $this->bookingDate = $bookingDate;
    }

    public function getValueDate(): string
    {
        return $this->valueDate;
    }

    public function setValueDate(string $valueDate): void
    {
        $this->valueDate = $valueDate;
    }

    public function getCreditorName(): ?string
    {
        return $this->creditorName;
    }

    public function setCreditorName(?string $creditorName): void
    {
        $this->creditorName = $creditorName;
    }

    public function getDebtorName(): ?string
    {
        return $this->debtorName;
    }

    public function setDebtorName(?string $debtorName): void
    {
        $this->debtorName = $debtorName;
    }

    public function getRemittanceInformationUnstructured(): string
    {
        return $this->remittanceInformationUnstructured;
    }

    public function setRemittanceInformationUnstructured(string $remittanceInformationUnstructured): void
    {
        $this->remittanceInformationUnstructured = $remittanceInformationUnstructured;
    }

    public function getTransactionAmount(): Amount
    {
        return $this->transactionAmount;
    }

    public function setTransactionAmount(object $transactionAmount): void
    {
        $this->transactionAmount = new Amount($transactionAmount);
    }

    public function getCreditorAccount(): ?Account
    {
        return $this->creditorAccount;
    }

    public function setCreditorAccount(?object $creditorAccount): void
    {
        $this->creditorAccount = new Account($creditorAccount);
    }

    public function getDebtorAccount(): ?Account
    {
        return $this->debtorAccount;
    }

    public function setDebtorAccount(?object $debtorAccount): void
    {
        $this->debtorAccount = new Account($debtorAccount);
    }
}
