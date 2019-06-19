<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$webHookId = 139;

$client = new CloudAppsClient($accessToken);
$response = $client->webHook->unSubscribe($webHookId);

print_r($response->getStatusCode());
