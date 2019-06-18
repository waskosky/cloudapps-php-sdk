<?php

use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Model\{Option, OrderQuote, OrderQuoteItem};

$apiKey = '***';
$client = new CloudAppsClient($apiKey);

$option = new Option();
$option->setOptionReference('paper_90off')
    ->setCount(1);

$itemQuote = new OrderQuoteItem();
$itemQuote->setReference('123')
    ->setCount(250)
    ->setProductReference('letterheading_ss_a4_2_0')
    ->addOption($option);

$orderQuote = new OrderQuote();
$orderQuote->setCountry('NL')
    ->addItem($itemQuote);

try {
    $response = $client->order->quote($orderQuote);
    print_r($response->getData());
} catch (ValidationException $e) {
    print_r($e->getValidationMessages());
}
