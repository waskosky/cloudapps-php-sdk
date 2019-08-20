<?php

namespace CloudPrinter\Tests\Authentication;

use CloudPrinter\CloudApps\Authentication\OAuth2;
use CloudPrinter\CloudApps\Exception\OAuth2ConfigMissingParamException;
use CloudPrinter\CloudApps\Http\Response;
use PHPUnit\Framework\TestCase;

/**
 * Class OAuth2Test
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OAuth2Test extends TestCase
{

    const CLIENT_ID = '123123';
    const REDIRECT_URL = 'redirect_url';
    const CLIENT_SECRET = '*secret*';
    const SCOPE = 'read';
    const AUTH_URL = 'https://api.cloudprinter.com/cloudauth/1.0/oauth2/authorize';

    /**
     * @var OAuth2
     */
    public $oAuth2;

    public function setUp()
    {
        $config = [
            'client_id' => self::CLIENT_ID,
            'redirect_uri' => self::REDIRECT_URL,
            'client_secret' => self::CLIENT_SECRET,
            'scope' => self::SCOPE
        ];

        $this->oAuth2 = new OAuth2($config);
    }

    public function testGetAuthorizationCodeUrl()
    {
        $authorizationCodeUrl = $this->oAuth2->getAuthorizationCodeUrl();
        $expected = sprintf(
            "%s?client_id=%s&redirect_uri=%s&scope=read&response_type=code&state=",
            self::AUTH_URL,
            self::CLIENT_ID,
            self::REDIRECT_URL
        ) . "%22%22";
        $this->assertEquals($expected, $authorizationCodeUrl);
    }

    public function testGetAccessToken()
    {
        $code = 123;
        $response = $this->oAuth2->getAccessToken($code);
        $this->assertInstanceOf(Response::class, $response);
    }

    public function testValidateConfigFail()
    {
        $config = [
            'client_id' => self::CLIENT_ID,
            'redirect_uri' => self::REDIRECT_URL,
            'client_secret' => self::CLIENT_SECRET,
        ];
        $this->expectException(OAuth2ConfigMissingParamException::class);
        new OAuth2($config);
    }
}
