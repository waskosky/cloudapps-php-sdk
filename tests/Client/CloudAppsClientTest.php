<?php

namespace CloudPrinter\Tests\Client;

use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class CloudAppsClientTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class CloudAppsClientTest extends TestCase
{
    const BASE_URL = 'https://api.cloudprinter.com/cloudapps/1.0/';
    const API_KEY = '123123';

    /**
     * @var CloudAppsClient
     */
    public $cloudAppsClient;

    public function setUp()
    {
        $this->cloudAppsClient = new CloudAppsClient(self::API_KEY);
    }

    public function testGetBaseUrl()
    {
        $baseUrl = $this->cloudAppsClient->getBaseUrl();
        $this->assertEquals(self::BASE_URL, $baseUrl);
    }

    public function testGetApiKey()
    {
        $apiKey = $this->cloudAppsClient->getApiKey();
        $this->assertEquals(self::API_KEY, $apiKey);
    }

    public function testMakeRequest()
    {
        $response = $this->cloudAppsClient->makeRequest('test', []);
        $this->assertInstanceOf(Response::class, $response);
    }
}
