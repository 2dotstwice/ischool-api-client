#!/usr/bin/env php
<?php

use Http\Message\MessageFactory\GuzzleMessageFactory;
use TwoDotsTwice\ISchoolApiClient\CheckSumCalculator;
use TwoDotsTwice\ISchoolApiClient\HttplugApiClient;

require __DIR__ . '/../vendor/autoload.php';

$client = $_SERVER['argv'][1];
$salt = $_SERVER['argv'][2];

$checksumCalculator = new CheckSumCalculator($salt);

$apiClient = new HttplugApiClient(
    new Http\Adapter\Guzzle6\Client(),
    new GuzzleMessageFactory(),
    new CheckSumCalculator($salt),
    $client
);

$activities = $apiClient->getActivities();

print count($activities) . PHP_EOL;