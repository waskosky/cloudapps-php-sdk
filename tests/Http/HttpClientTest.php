<?php

namespace CloudPrinter\CloudApps\Tests\Http;

use CloudPrinter\CloudApps\Http\HttpClient;
use CloudPrinter\CloudApps\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class HttpClientTest
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class HttpClientTest extends TestCase
{
    public function testMakePostSuccess()
    {
        $baseUrl = 'https://jsonplaceholder.typicode.com/';
        $request = new HttpClient($baseUrl, []);
        $response = $request->makeRequest('posts');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testMakePostFail()
    {
        $request = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->getMock();
        $response = $request->makeRequest('test');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testMakeDeleteSuccess()
    {
        $baseUrl = 'https://jsonplaceholder.typicode.com/';
        $request = new HttpClient($baseUrl, []);
        $response = $request->makeRequest('posts/1', [], 'delete');

        $this->assertInstanceOf(Response::class, $response);
    }

    public function testMakeRequestWithWrongMethodSuccess()
    {
        $baseUrl = 'https://jsonplaceholder.typicode.com/';
        $request = new HttpClient($baseUrl, []);
        $response = $request->makeRequest('posts', ['json' => []], 'test');

        $this->assertInstanceOf(Response::class, $response);
    }
}
