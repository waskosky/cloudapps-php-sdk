<?php

namespace CloudPrinter\Tests\Action\CloudApps;

use CloudPrinter\CloudApps\Action\OrderAction;
use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Http\Response;
use CloudPrinter\CloudApps\Model\Order;
use CloudPrinter\CloudApps\Model\OrderQuote;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderActionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderActionTest extends TestCase
{
    /**
     * @var OrderAction
     */
    public $orderAction;

    public function setUp()
    {
        $apiKey = 123;
        $client = new CloudAppsClient($apiKey);
        $this->orderAction = new OrderAction($client);
    }

    public function testCreate()
    {
        $order = $this->getMockBuilder(Order::class)
            ->getMock();

        $order->expects($this->once())
            ->method('toArray')
            ->willReturn([]);

        $result = $this->orderAction->create($order);
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testGetList()
    {
        $result = $this->orderAction->getList();
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testGetInfo()
    {
        $reference = '123';
        $result = $this->orderAction->getInfo($reference);
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testCancel()
    {
        $reference = '123';
        $result = $this->orderAction->cancel($reference);
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testGetLog()
    {
        $reference = '123';
        $result = $this->orderAction->getLog($reference);
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testQuote()
    {
        $orderQuote = $this->getMockBuilder(OrderQuote::class)
            ->getMock();

        $orderQuote->expects($this->once())
            ->method('toArray')
            ->willReturn([]);

        $result = $this->orderAction->quote($orderQuote);
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testQuoteInfo()
    {
        $hash = md5(time());
        $result = $this->orderAction->quoteInfo($hash);
        $this->assertInstanceOf(Response::class, $result);
    }
}
