#!/usr/bin/env php
<?php

use Http\Message\MessageFactory\GuzzleMessageFactory;
use TwoDotsTwice\ISchoolApiClient\CheckSumCalculator;
use TwoDotsTwice\ISchoolApiClient\HttplugApiClient;

require __DIR__ . '/../vendor/autoload.php';

$client = $_SERVER['argv'][1];
$salt = $_SERVER['argv'][2];
$id = $_SERVER['argv'][3] ?? NULL;

$checksumCalculator = new CheckSumCalculator($salt);

$apiClient = new HttplugApiClient(
    new Http\Adapter\Guzzle6\Client(),
    new GuzzleMessageFactory(),
    new CheckSumCalculator($salt),
    $client
);

$activities = $apiClient->getActivities();

print count($activities) . PHP_EOL;

foreach ($activities as $activity) {
    if ($id) {
        var_dump($activity);
        break;
    }
    else {
        print $activity->getId() . ': ' . $activity->getDescription() . PHP_EOL;
    }
}
