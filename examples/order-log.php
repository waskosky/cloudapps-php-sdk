<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$orderReference = '123';

$client = new CloudAppsClient($accessToken);
$response = $client->order->getLog($orderReference);

print_r($response->getData());
