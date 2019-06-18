<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$orderReference = '123';

$client = new CloudAppsClient($apiKey);
$response = $client->order->getLog($orderReference);

print_r($response->getData());
