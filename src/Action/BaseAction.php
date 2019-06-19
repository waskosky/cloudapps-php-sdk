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

        $config = [
            'base_url' => $client->getBaseUrl(),
            'defaults' => [
                'headers' => ['Authorization' => $this->getAuthorization()]
            ]
        ];
        $this->httpClient = new HttpClient($config);
    }

    /**
     * @return string
     */
    private function getAuthorization()
    {
        return 'Bearer ' . $this->client->getAccessToken();
    }
}
