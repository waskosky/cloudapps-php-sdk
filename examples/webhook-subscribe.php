<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$url = 'test.com';
$client = new CloudAppsClient($apiKey);
$response = $client->webHook->subscribe($url);

print_r($response->getData());
