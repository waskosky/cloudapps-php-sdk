<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$client = new CloudAppsClient($apiKey);
$response = $client->order->getList();

print_r($response->getData());
