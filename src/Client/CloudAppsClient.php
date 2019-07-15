<?php

namespace CloudPrinter\CloudApps\Client;

use CloudPrinter\CloudApps\Action\OrderAction;
use CloudPrinter\CloudApps\Action\PriceAction;
use CloudPrinter\CloudApps\Action\ProductAction;
use CloudPrinter\CloudApps\Action\ShippingAction;
use CloudPrinter\CloudApps\Action\UserAction;
use CloudPrinter\CloudApps\Action\WebHookAction;
use CloudPrinter\CloudApps\Http\HttpClient;
use CloudPrinter\CloudApps\Http\Response;

/**
 * Class CloudAppsClient
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class CloudAppsClient implements ClientInterface
{
    /**
     * Base url for CloudApps.
     */
    const CLOUD_APPS_URL = 'https://api.cloudprinter.com/cloudapps/1.0/';

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

    /** @var UserAction */
    public $user;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * CloudCoreClient constructor.
     * @param string $accessToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->order = new OrderAction($this);
        $this->product = new ProductAction($this);
        $this->webHook = new WebHookAction($this);
        $this->shipping = new ShippingAction($this);
        $this->price = new PriceAction($this);
        $this->user = new UserAction($this);
    }

    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getBaseUrl()
    {
        return self::CLOUD_APPS_URL;
    }

    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $uri
     * @param array $data
     * @param string $method
     * @return Response
     */
    public function makeRequest(string $uri, array $data = null, $method = 'post')
    {
        $baseUrl = $this->getBaseUrl();
        $httpHeaders = [
            'Authorization: Bearer' . $this->getAccessToken(),
            'Content-Type: application/json'
        ];

        $httpClient = new HttpClient($baseUrl, $httpHeaders);
        $response = $httpClient->makeRequest($uri, $data, $method);

        return $response;
    }
}
