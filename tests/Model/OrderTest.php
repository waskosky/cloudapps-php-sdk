<?php

namespace CloudPrinter\CloudApps\Tests\Model\CloudApps;

use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Model\Address;
use CloudPrinter\CloudApps\Model\Order;
use CloudPrinter\CloudApps\Model\OrderItem;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderTest extends TestCase
{
    public function testOrderSuccess()
    {
        $item = $this->getMockBuilder(OrderItem::class)
            ->getMock();

        $address = $this->getMockBuilder(Address::class)
            ->getMock();

        $order = new Order();
        $order
            ->setEmail('test@cloudprinter.com')
            ->setMode('sendbox')
            ->setReference('123')
            ->setPrice('100')
            ->setCurrency('USD')
            ->setHc('test')
            ->addItem($item)
            ->addAddress($address);

        $orderAsArray = $order->toArray();

        $expectedSubset = [
            'reference' =>  123,
            'mode' =>  'sendbox',
            'email' => 'test@cloudprinter.com',
            'price' => '100',
            'currency' => 'USD',
            'hc' => 'test',
            'items' => [],
            'addresses' => []
        ];
        $this->assertArraySubset($expectedSubset, $orderAsArray);
    }

    public function testOrderFail()
    {
        $item = $this->getMockBuilder(OrderItem::class)
            ->getMock();

        $address = $this->getMockBuilder(Address::class)
            ->getMock();

        $order = new Order();
        $order
            ->setEmail('test@cloudprinter.com')
            ->addItem($item)
            ->addAddress($address);

        $this->expectException(ValidationException::class);
        $order->toArray();
    }
}
