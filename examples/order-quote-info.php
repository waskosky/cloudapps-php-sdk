<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$quoteHash = '123';

$client = new CloudAppsClient($accessToken);
$response = $client->order->quoteInfo($quoteHash);

print_r($response->getData());
