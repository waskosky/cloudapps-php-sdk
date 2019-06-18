<?php

namespace CloudPrinter\Tests\Action\CloudApps;

use CloudPrinter\CloudApps\Action\PriceAction;
use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Http\Response;
use CloudPrinter\CloudApps\Model\OrderQuote;
use PHPUnit\Framework\TestCase;

/**
 * Class PriceActionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class PriceActionTest extends TestCase
{
    /**
     * @var PriceAction
     */
    public $priceAction;

    public function setUp()
    {
        $apiKey = 123;
        $client = new CloudAppsClient($apiKey);
        $this->priceAction = new PriceAction($client);
    }

    public function testLookup()
    {
        $orderQuote = $this->getMockBuilder(OrderQuote::class)
            ->getMock();

        $orderQuote->expects($this->once())
            ->method('toArray')
            ->willReturn([]);

        $result = $this->priceAction->lookup($orderQuote);
        $this->assertInstanceOf(Response::class, $result);
    }
}
