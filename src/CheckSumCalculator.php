<?php

namespace TwoDotsTwice\ISchoolApiClient;

class CheckSumCalculator
{
    private $salt;

    public function __construct(string $salt)
    {
        $this->salt = $salt;
    }

    public function checkSum(string $partnerId, string $client, string $type): string
    {
        $saltedString = $this->saltedString($partnerId, $client, $type);
        return strtoupper(md5($saltedString));
    }

    private function saltedString(string $partnerId, string $client, string $type): string
    {
        return $partnerId . $client . $type . $this->salt;
    }
}
