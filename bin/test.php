#!/usr/bin/env php
<?php

use Http\Message\MessageFactory\GuzzleMessageFactory;
use TwoDotsTwice\ISchoolApiClient\CheckSumCalculator;
use TwoDotsTwice\ISchoolApiClient\HttplugApiClient;
use TwoDotsTwice\ISchoolApiClient\Model\GetActivitiesParameters;

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

$today = new \DateTimeImmutable();
// End date 3 years from now.
$endDate = $today->add(new \DateInterval('P3Y'));

$parameters = new GetActivitiesParameters();
$parameters = $parameters->withEndDate($endDate);

$activities = $apiClient->getActivities($parameters);

print count($activities) . PHP_EOL;

foreach ($activities as $activity) {
    if (!$id || (string)$activity->getId() == $id) {
        print $activity->getId() . ': ' . $activity->getDescription() . PHP_EOL;
        print 'max reservations: ' . $activity->getMaxReservations() . PHP_EOL;
        print 'current reservations: ' . $activity->getCurrentReservations() . PHP_EOL;
    }
}
