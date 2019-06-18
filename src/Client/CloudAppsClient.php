<?php

namespace CloudPrinter\CloudApps\Client;

use CloudPrinter\CloudApps\Action\OrderAction;
use CloudPrinter\CloudApps\Action\PriceAction;
use CloudPrinter\CloudApps\Action\ProductAction;
use CloudPrinter\CloudApps\Action\ShippingAction;
use CloudPrinter\CloudApps\Action\WebHookAction;
use CloudPrinter\CloudApps\Http\HttpClient;
use CloudPrinter\CloudApps\Http\Response;

/**
 * Class CloudAppsClient
 *+
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class CloudAppsClient implements ClientInterface
{
    /** @var OrderAction */
    public $order;

    /** @var ProductAction */
    public $product;

    /** @var WebHookAction */
    public $webHook;

    /** @var ShippingAction */
    public $shipping;

    /** @var PriceAction */
    public $price;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * CloudCoreClient constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->order = new OrderAction($this);
        $this->product = new ProductAction($this);
        $this->webHook = new WebHookAction($this);
        $this->shipping = new ShippingAction($this);
        $this->price = new PriceAction($this);
    }

    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getBaseUrl()
    {
        return 'https://api.cloudprinter.com/cloudapps/1.0/';
    }

    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $uri
     * @param array $data
     * @param string $method
     * @return Response
     */
    public function makeRequest(string $uri, array $data = null, $method = 'post')
    {
        $config = [
            'base_url' => $this->getBaseUrl(),
            'defaults' => [
                'headers' => ['Authorization' => 'Bearer ' . $this->getApiKey()]
            ]
        ];
        $httpClient = new HttpClient($config);
        $response = $httpClient->makeRequest($uri, $data, $method);

        return $response;
    }
}
