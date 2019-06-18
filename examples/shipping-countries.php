<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$client = new CloudAppsClient($apiKey);
$response = $client->shipping->getCountries();

print_r($response->getData());
