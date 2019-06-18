<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$quoteHash = '123';

$client = new CloudAppsClient($apiKey);
$response = $client->order->quoteInfo($quoteHash);

print_r($response->getData());
