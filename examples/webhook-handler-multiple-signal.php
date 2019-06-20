<?php

use CloudPrinter\CloudApps\CloudSignal\CloudSignalHandler;

$cloudSignalApiKey = '***';
$cloudSignalHandler = new CloudSignalHandler($cloudSignalApiKey);

$signals = [
    'ItemProduced',
    'ItemProduced',
    'CloudprinterOrderValidated',
];

$cloudSignalHandler->on($signals, function(array $signalData) {
    // handle
});
