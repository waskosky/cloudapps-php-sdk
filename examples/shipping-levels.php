<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$client = new CloudAppsClient($apiKey);
$response = $client->shipping->getLevels();

print_r($response->getData());
