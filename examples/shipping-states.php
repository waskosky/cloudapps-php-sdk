<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$countryReference = 'US';
$client = new CloudAppsClient($accessToken);
$response = $client->shipping->getStates($countryReference);

print_r($response->getData());
