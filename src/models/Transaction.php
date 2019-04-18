<?php
declare(strict_types=1);

namespace Degordian\ErsteBankClient\models;


class Transaction
{
    private $transactionId;
    private $endToEndId;
    private $bookingDate;
    private $valueDate;
    private $creditorName;
    private $remittanceInformationUnstructured;
    private $transactionAmount;
    private $creditorAccount;

    public function __construct(object $data)
    {
        $this->transactionId = $data->transactionId;
        $this->endToEndId = $data->endToEndId;
        $this->bookingDate = $data->bookingDate;
        $this->valueDate = $data->valueDate;
        $this->creditorName = $data->creditorName;
        $this->remittanceInformationUnstructured = $data->remittanceInformationUnstructured;
        $this->transactionAmount = new TransactionAmount($data->transactionAmount);
        $this->creditorAccount = new CreditorAccount($data->creditorAccount);
    }

    public function getTransactionId(): string
    {
        return $this->transactionId;
    }

    public function setTransactionId(string $transactionId): void
    {
        $this->transactionId = $transactionId;
    }

    public function getEndToEndId(): string
    {
        return $this->endToEndId;
    }

    public function setEndToEndId(string $endToEndId): void
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

    public function getCreditorName(): string
    {
        return $this->creditorName;
    }

    public function setCreditorName(string $creditorName): void
    {
        $this->creditorName = $creditorName;
    }

    public function getRemittanceInformationUnstructured(): string
    {
        return $this->remittanceInformationUnstructured;
    }

    public function setRemittanceInformationUnstructured(string $remittanceInformationUnstructured): void
    {
        $this->remittanceInformationUnstructured = $remittanceInformationUnstructured;
    }

    public function getTransactionAmount(): TransactionAmount
    {
        return $this->transactionAmount;
    }

    public function setTransactionAmount(object $transactionAmount): void
    {
        $this->transactionAmount = new TransactionAmount($transactionAmount);
    }

    public function getCreditorAccount(): CreditorAccount
    {
        return $this->creditorAccount;
    }

    public function setCreditorAccount(object $creditorAccount): void
    {
        $this->creditorAccount = new CreditorAccount($creditorAccount);
    }
}
