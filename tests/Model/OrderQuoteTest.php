<?php

namespace CloudPrinter\Tests\Model\CloudApps;

use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Model\OrderQuote;
use CloudPrinter\CloudApps\Model\OrderQuoteItem;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderQuoteTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderQuoteTest extends TestCase
{
    public function testOrderQuoteSuccess()
    {
        $item = $this->getMockBuilder(OrderQuoteItem::class)->getMock();

        $orderQuote = new OrderQuote();
        $orderQuote->setCountry('US')
            ->setState('AI')
            ->addItem($item);

        $orderQuoteAsArray = $orderQuote->toArray();
        $expectedSubset = [
            'country' => 'US',
            'state' => 'AI'
        ];

        $this->assertArraySubset($expectedSubset, $orderQuoteAsArray);
    }

    public function testOrderFail()
    {
        $item = $this->getMockBuilder(OrderQuoteItem::class)->getMock();

        $orderQuote = new OrderQuote();
        $orderQuote->setCountry('US')
            ->addItem($item);

        $this->expectException(ValidationException::class);
        $orderQuote->toArray();
    }
}
