<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$client = new CloudAppsClient($accessToken);
$response = $client->shipping->getLevels();

print_r($response->getData());
