<?php

namespace CloudPrinter\Tests\Action\CloudApps;

use CloudPrinter\CloudApps\Action\ShippingAction;
use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ShippingActionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ShippingActionTest extends TestCase
{
    /**
     * @var ShippingAction
     */
    public $shippingAction;

    public function setUp()
    {
        $apiKey = 123;
        $client = new CloudAppsClient($apiKey);
        $this->shippingAction = new ShippingAction($client);
    }

    public function testGetLevels()
    {
        $result = $this->shippingAction->getLevels();
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testCountries()
    {
        $result = $this->shippingAction->getCountries();
        $this->assertInstanceOf(Response::class, $result);
    }
}
