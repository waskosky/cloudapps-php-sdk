<?php

namespace CloudPrinter\Tests\Action\CloudApps;

use CloudPrinter\CloudApps\Action\WebHookAction;
use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class WebHookActionTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class WebHookActionTest extends TestCase
{
    /**
     * @var WebHookAction
     */
    public $webHookAction;

    public function setUp()
    {
        $accessToken = 123;
        $client = new CloudAppsClient($accessToken);
        $this->webHookAction = new WebHookAction($client);
    }

    public function testSubscribe()
    {
        $url = 'www.test.com';
        $result = $this->webHookAction->subscribe($url);
        $this->assertInstanceOf(Response::class, $result);
    }

    public function testUnSubscribe()
    {
        $webHookId = 25;
        $result = $this->webHookAction->unSubscribe($webHookId);
        $this->assertInstanceOf(Response::class, $result);
    }
}
