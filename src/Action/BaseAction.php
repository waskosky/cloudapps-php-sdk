<?php

namespace CloudPrinter\CloudApps\Action;

use CloudPrinter\CloudApps\Client\ClientInterface;
use CloudPrinter\CloudApps\Http\HttpClient;

/**
 * Class BaseAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class BaseAction
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * BaseAction constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;

        $baseUrl = $client->getBaseUrl();
        $httpHeaders = [
            'Authorization: ' . $this->getAuthorization(),
            'Content-Type: application/json'
        ];
        $this->httpClient = new HttpClient($baseUrl, $httpHeaders);
    }

    /**
     * @return string
     */
    private function getAuthorization()
    {
        return 'Bearer ' . $this->client->getAccessToken();
    }
}
