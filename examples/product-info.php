<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$productReference = 'folder_s150_s_fc';
$client = new CloudAppsClient($apiKey);
$response = $client->product->getInfo($productReference);

print_r($response->getData());
