<?php

namespace CloudPrinter\CloudApps\Tests\WebHook;

use CloudPrinter\CloudApps\Exception\WebHookApiKeyException;
use CloudPrinter\CloudApps\WebHook\WebHookHandler;
use PHPUnit\Framework\TestCase;

/**
 * Class WebHookHandlerTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class WebHookHandlerTest extends TestCase
{
    public function testOn()
    {
        $webHookApiKey = '123';
        $webHookHandler = $this->getMockBuilder(WebHookHandler::class)
            ->setConstructorArgs([$webHookApiKey])
            ->setMethods(['getWebHookData'])
            ->getMock();

        $webHookHandler->expects($this->any())
            ->method('getWebHookData')
            ->willReturn([
                "apikey" => "123",
                "type" => "ItemShipped",
                "order" => "21034900000000",
                "item" => "21034901040001",
                "order_reference" => "wp-a18310ee15a8d8ef9010fee2fea95686",
                "item_reference" => "99",
                "datetime" => "2019-05-30T09:49:34+00:00",
                "tracking" => "SANDBOX_99",
                "shipping_option" => "postal"
            ]);

        $webHookHandler->on(['ItemShipped', 'ItemError'], function ($webHookData) {
            echo 'ItemShipped';
        });

        $this->expectOutputString('ItemShipped');
    }

    public function testOnFail()
    {
        $webHookApiKey = '111';
        $webHookHandler = $this->getMockBuilder(WebHookHandler::class)
            ->setConstructorArgs([$webHookApiKey])
            ->setMethods(['getWebHookData'])
            ->getMock();

        $webHookHandler->expects($this->any())
            ->method('getWebHookData')
            ->willReturn([
                "apikey" => "123",
                "type" => "ItemShipped",
                "order" => "21034900000000",
                "item" => "21034901040001",
                "order_reference" => "wp-a18310ee15a8d8ef9010fee2fea95686",
                "item_reference" => "99",
                "datetime" => "2019-05-30T09:49:34+00:00",
                "tracking" => "SANDBOX_99",
                "shipping_option" => "postal"
            ]);

        $this->expectException(WebHookApiKeyException::class);

        $webHookHandler->on(['ItemShipped', 'ItemError'], function ($webHookData) {
            echo 'ItemShipped';
        });
    }

    public function testAll()
    {
        $webHookApiKey = '123';
        $webHookHandler = $this->getMockBuilder(WebHookHandler::class)
            ->setConstructorArgs([$webHookApiKey])
            ->setMethods(['getWebHookData'])
            ->getMock();

        $webHookHandler->expects($this->any())
            ->method('getWebHookData')
            ->willReturn([
                "apikey" => "123",
                "type" => "ItemShipped",
                "order" => "21034900000000",
                "item" => "21034901040001",
                "order_reference" => "wp-a18310ee15a8d8ef9010fee2fea95686",
                "item_reference" => "99",
                "datetime" => "2019-05-30T09:49:34+00:00",
                "tracking" => "SANDBOX_99",
                "shipping_option" => "postal"
            ]);

        $webHookHandler->onAll(function ($webHookData) {
            echo 'ItemShipped';
        });

        $this->expectOutputString('ItemShipped');
    }
}
