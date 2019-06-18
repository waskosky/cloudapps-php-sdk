<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$apiKey = '***';
$webHookId = 139;

$client = new CloudAppsClient($apiKey);
$response = $client->webHook->unSubscribe($webHookId);

print_r($response->getStatusCode());
