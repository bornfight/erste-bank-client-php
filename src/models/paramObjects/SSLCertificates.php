<?php
declare(strict_types=1);

namespace Bornfight\ErsteBankClient\models\paramObjects;


class SSLCertificates
{
    private $pemFilePath;
    private $keyFilePath;

    public function __construct(string $pemFilePath, string $keyFilePath)
    {
        $this->pemFilePath = $pemFilePath;
        $this->keyFilePath = $keyFilePath;
    }

    public function getPemFilePath(): string
    {
        return $this->pemFilePath;
    }

    public function getKeyFilePath(): string
    {
        return $this->keyFilePath;
    }
}
