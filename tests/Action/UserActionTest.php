<?php

namespace CloudPrinter\Tests\Action\CloudApps;

use CloudPrinter\CloudApps\Action\UserAction;
use CloudPrinter\CloudApps\Client\CloudAppsClient;
use CloudPrinter\CloudApps\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class UserActionTest
 *
 * @copyright 2019 by CloudPrinter
 * @author    Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class UserActionTest extends TestCase
{
    /**
     * @var UserAction
     */
    public $userAction;

    public function setUp()
    {
        $accessToken = 123;
        $client = new CloudAppsClient($accessToken);
        $this->userAction = new UserAction($client);
    }

    public function testGetInfo()
    {
        $result = $this->userAction->getInfo();
        $this->assertInstanceOf(Response::class, $result);
    }
}
