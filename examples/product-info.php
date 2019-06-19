<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$productReference = 'folder_s150_s_fc';
$client = new CloudAppsClient($accessToken);
$response = $client->product->getInfo($productReference);

print_r($response->getData());
