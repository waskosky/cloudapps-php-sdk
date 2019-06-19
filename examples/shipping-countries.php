<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$client = new CloudAppsClient($accessToken);
$response = $client->shipping->getCountries();

print_r($response->getData());
