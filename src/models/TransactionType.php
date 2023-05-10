<?php
declare(strict_types=1);

namespace Bornfight\ErsteBankClient\models;


class TransactionType
{
    private $booked;
    private $pending;

    public function __construct(object $data)
    {
        $this->setBooked($data->booked ?? []);
        $this->setPending($data->pending ?? []);
    }

    /**
     * @return Transaction[]
     */
    public function getBooked(): array
    {
        return $this->booked;
    }

    public function setBooked(array $booked): void
    {
        $this->booked = array_map(function ($transaction) {
            return new Transaction($transaction);
        }, $booked);
    }

    /**
     * @return Transaction[]
     */
    public function getPending(): array
    {
        return $this->pending;
    }

    public function setPending(array $pending): void
    {
        $this->pending = array_map(function ($transaction) {
            return new Transaction($transaction);
        }, $pending);
    }
}
