<?php

use CloudPrinter\CloudApps\WebHook\WebHookHandler;

$webHookApiKey = '***';
$webHookHandler = new WebHookHandler($webHookApiKey);

// handle ItemShipped signal
$webHookHandler->onItemShipped(function(array $webHookData) {
   // handle
});

// handle CloudprinterOrderCanceled signal
$webHookHandler->onCloudprinterOrderCanceled(function(array $webHookData) {
    // handle
});

// handle CloudprinterOrderValidated signal
$webHookHandler->onCloudprinterOrderValidated(function(array $webHookData) {
    // handle
});

// handle ItemCanceled signal
$webHookHandler->onItemCanceled(function(array $webHookData) {
    // handle
});

// handle ItemError signal
$webHookHandler->onItemError(function(array $webHookData) {
    // handle
});

// handle ItemPacked signal
$webHookHandler->onItemPacked(function(array $webHookData) {
    // handle
});

// handle ItemProduced signal
$webHookHandler->onItemProduced(function(array $webHookData) {
    // handle
});

// handle ItemProduced, ItemProduced, CloudprinterOrderValidated signals in one function
$signals = [
    'ItemProduced',
    'ItemProduced',
    'CloudprinterOrderValidated',
];

$webHookHandler->on(['ItemProduced', ], function(array $webHookData) {
    // handle
});
