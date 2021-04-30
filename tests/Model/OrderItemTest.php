<?php

namespace CloudPrinter\CloudApps\Tests\Model\CloudApps;

use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Model\File;
use CloudPrinter\CloudApps\Model\Option;
use CloudPrinter\CloudApps\Model\OrderItem;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderItemTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderItemTest extends TestCase
{
    public function testOrderItemSuccess()
    {
        $file = $this->getMockBuilder(File::class)->getMock();
        $option = $this->getMockBuilder(Option::class)->getMock();

        $item = new OrderItem();
        $item->setReference('123')
            ->setProductReference('textbook_cw_a6_p_bw')
            ->setTitle('test')
            ->setCount(2)
            ->addFile($file)
            ->addOption($option)
            ->setPrice(100)
            ->setCurrency('eur')
            ->setHc('hc')
            ->setReorderCause('reorder cause')
            ->setReorderDescription('reorder description')
            ->setReorderOrderReference('order123213')
            ->setReorderItemReference('item123213')
            ->setQuote('123');

        $itemAsArray = $item->toArray();

        $expectedSubset = [
            'reference' => '123',
            'product_reference' => 'textbook_cw_a6_p_bw',
            'title' => 'test',
            'count' => 2,
            'price' => 100,
            'currency' => 'eur',
            'hc' => 'hc',
            'reorder_cause' => 'reorder cause',
            'reorder_desc' => 'reorder description',
            'reorder_order_reference' => 'order123213',
            'reorder_item_reference' => 'item123213',
            'quote' => '123'
        ];

        $this->assertArraySubset($expectedSubset, $itemAsArray);
    }


    public function testStockOrderItemSuccess()
    {
        $item = new OrderItem();
        $item->setReference('123')
            ->setProductReference('textbook_cw_a6_p_bw')
            ->setCount(2)
            ->setType('stock')
            ->setQuote('123');
        $itemAsArray = $item->toArray();

        $expectedSubset = [
            'reference' => '123',
            'product_reference' => 'textbook_cw_a6_p_bw',
            'type' => 'stock',
            'count' => 2,
            'quote' => '123'
        ];

        $this->assertArraySubset($expectedSubset, $itemAsArray);
    }

    public function testOrderItemFail()
    {
        $file = $this->getMockBuilder(File::class)->getMock();
        $option = $this->getMockBuilder(Option::class)->getMock();

        $item = new OrderItem();
        $item->setProductReference('textbook_cw_a6_p_bw')
            ->setTitle('test')
            ->setCount(2)
            ->addFile($file)
            ->addOption($option)
            ->setPrice(100)
            ->setCurrency('eur')
            ->setHc('hc')
            ->setReorderCause('reorder cause')
            ->setReorderDescription('reorder description')
            ->setReorderOrderReference('order123213')
            ->setReorderItemReference('item123213');

        $this->expectException(ValidationException::class);
        $item->toArray();
    }
}
