<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$url = 'test.com';
$client = new CloudAppsClient($accessToken);
$response = $client->webHook->subscribe($url);

print_r($response->getData());
