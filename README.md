# CloudApps PHP SDK
The Cloudprinter.com PHP SDK is a library with useful features that enable App developers to easily integrate their application with Cloudprinter.com and make requests to our CloudApps API. This PHP SDK makes it easy to set up the integration between your App and the Cloudprinter.com Print Cloud to request instant pricing, post print orders, get production signals back, and more. 

The CloudApps API is exclusively designed for app developers.

We at Cloudprinter.com have connected 150+ printers to print & ship print products in almost any country in the world. Whether this is around the corner or at the other side of the globe, we've got you covered: we can deliver 500+ different products in more than 100 countries currently.

Our platform makes use of smart routing algoritms to route any print job to the most local and qualified printer. Based on location, performance, price and production options, your print job is routed by these algorithms to the nearest printing facility near your delivery address to help you save on transit times and costs.

Visit our [website](https://www.cloudprinter.com) for more information on all the products and services that we offer.

## Installation 
The CloudApps SDK can be installed with Composer. Run this command:
```
composer require cloudprinter/cloudapps
```

## Prerequisites
* composer (for installation)
* php 7.0 or above
* json, fileinfo extensions must be enabled
* Cloudprinter.com Print Cloud account

## Creating an app
The CloudApps API is designed as backend for integrated apps. An app could as an example an e-commerce system integration.

Each app needs to be created in the Cloudprinter.com system. Please contact Cloudprinter.com support team for this.

## Authentication
Authentication is done via OAuth2.

Each app requires a unique client identifier, client password and a return URL. This information is required for Cloudprinter.com support team when creating the app.

The Cloudprinter.com user login grants access to the CloudApps API.

## Examples
### Get access token.
```
use CloudPrinter\CloudApps\Authentication\OAuth2;

$config = [
    'client_id' => '***',
    'client_secret' => '***',
    'redirect_uri' => 'http://www.your-site.com',
    'scope' => 'read-write'
];
$oAuth2 = new OAuth2($config);

// Step 1. Getting url for authorization code.
$authorizationCodeUrl = $oAuth2->getAuthorizationCodeUrl();

// Step 2. Getting access token by authorization code that comes to redirect url.
$code = $_GET['code'];
$accessToken = $oAuth2->getAccessToken($code);

```
### Get list of orders.
```
use CloudPrinter\CloudApps\Client\CloudAppsClient;

$accessToken = '***';
$client = new CloudAppsClient($accessToken);
$response = $client->order->getList();

print_r($response->getData());
```
### Create new order.
```
use CloudPrinter\CloudCore\Client\CloudCoreClient;
use CloudPrinter\CloudCore\Exception\ValidationException;
use CloudPrinter\CloudCore\Model\{Address, File, OrderItem, Order, Option};

$accessToken = '***';
$client = new CloudAppsClient($accessToken);

$address = new Address();
$address->setEmail('test@mail.com')
    ->setFirstName('John')
    ->setLastName('Doe')
    ->setCountry('NL')
    ->setCity('Amsterdam')
    ->setStreet('Street1')
    ->setPhone('+31-655-538-848')
    ->setZip('1071 JA')
    ->setType('delivery');

$fileCover = new File();
$fileCover->setUrl('https://s3-eu-west-1.amazonaws.com/demo.cloudprinter.com/b52f510a5e2419f67c4925153ec0c080_v2/CP_Sample_doc_A4_Book_Cover_Textbook_80_gsm_Casewrap_v2.1.pdf')
    ->setType('cover');

$fileBook = new File();
$fileBook->setUrl('https://s3-eu-west-1.amazonaws.com/demo.cloudprinter.com/b52f510a5e2419f67c4925153ec0c080_v2/CP_Sample_doc_A4_Book_Interior_Textbook_v2.1.pdf')
    ->setType('book');

$item = new OrderItem();
$item->setReference('item-1')
    ->setCount(1)
    ->setProductReference('textbook_cw_a4_p_bw')
    ->addFile($fileCover)
    ->addFile($fileBook)
    ->addOption(new Option('cover_finish_gloss', 1))
    ->addOption(new Option('pageblock_80off', 1))
    ->addOption(new Option('cover_130mcg', 1))
    ->addOption(new Option('total_pages', 100));

$order = new Order();
$order
    ->setEmail('test@mail.com')
    ->setReference('sdk-' . time())
    ->addItem($item)
    ->addAddress($address);

try {
    $response = $client->order->create($order);
    print_r($response->getData());
} catch (ValidationException $e) {
    print_r($e->getValidationMessages());
}
```
