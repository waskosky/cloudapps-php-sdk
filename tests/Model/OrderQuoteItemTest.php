<?php

namespace CloudPrinter\CloudApps\Tests\Model\CloudApps;

use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Model\Option;
use CloudPrinter\CloudApps\Model\OrderQuoteItem;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderQuoteItemTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderQuoteItemTest extends TestCase
{
    public function testOrderQuoteSuccess()
    {
        $option = $this->getMockBuilder(Option::class)->getMock();

        $itemQuote = new OrderQuoteItem();
        $itemQuote->setReference('123')
            ->setCount(1)
            ->setProductReference('textbook_cw_a6_p_bw')
            ->addOption($option);

        $expectedSubset = [
            'reference' => '123',
            'product_reference' => 'textbook_cw_a6_p_bw',
            'count' => 1
        ];

        $itemQuoteAsArray = $itemQuote->toArray();
        $this->assertArraySubset($expectedSubset, $itemQuoteAsArray);
    }

    public function testOrderQuoteFail()
    {
        $option = $this->getMockBuilder(Option::class)->getMock();

        $itemQuote = new OrderQuoteItem();
        $itemQuote->setCount(1)
            ->setProductReference('textbook_cw_a6_p_bw')
            ->addOption($option);

        $this->expectException(ValidationException::class);
        $itemQuote->toArray();
    }
}
