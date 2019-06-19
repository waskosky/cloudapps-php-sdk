<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$client = new CloudAppsClient($accessToken);
$response = $client->product->getList();

print_r($response->getData());
