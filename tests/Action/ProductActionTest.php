<?php

namespace CloudPrinter\Tests\Action\CloudApps;

use CloudPrinter\CloudApps\Action\ProductAction;
use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class ProductActionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ProductActionTest extends TestCase
{
    /**
     * @var ProductAction
     */
    public $productAction;

    public function setUp()
    {
        $apiKey = 123;
        $client = new CloudAppsClient($apiKey);
        $this->productAction = new ProductAction($client);
    }

    public function testGetList()
    {
        $result = $this->productAction->getList();
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testGetInfo()
    {
        $reference = '123';
        $result = $this->productAction->getInfo($reference);
        $this->assertInstanceOf(Response::class, $result);
    }
}
