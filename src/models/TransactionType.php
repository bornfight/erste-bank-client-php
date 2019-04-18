<?php
declare(strict_types=1);

namespace Degordian\ErsteBankClient\models;


class TransactionType
{
    private $booked;

    public function __construct(object $data)
    {
        $this->setBooked($data->booked);
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
}
