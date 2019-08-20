<?php

namespace CloudPrinter\CloudApps\Authentication;

use CloudPrinter\CloudApps\Exception\OAuth2ConfigMissingParamException;
use CloudPrinter\CloudApps\Http\HttpClient;
use CloudPrinter\CloudApps\Http\Response;

/**
 * Class OAuth2
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OAuth2
{
    const BASE_AUTH_URL = 'https://api.cloudprinter.com/cloudauth/1.0/';

    /**
     * @var array
     */
    private $config;

    /**
     * OAuth2 constructor.
     * @param array $config
     * @throws OAuth2ConfigMissingParamException
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->validateConfig();
    }

    /**
     * @return string
     */
    public function getAuthorizationCodeUrl()
    {
        $data = [
            'client_id=' . $this->config['client_id'],
            'redirect_uri=' . $this->config['redirect_uri'],
            'scope=' . $this->config['scope'],
            'response_type=code',
            'state=' . ($this->config['state'] ?? urlencode('""'))
        ];

        return self::BASE_AUTH_URL . 'oauth2/authorize?' . join('&', $data);
    }

    /**
     * @param string $code
     * @return Response
     */
    public function getAccessToken(string $code): Response
    {
        $baseUrl = self::BASE_AUTH_URL;
        $headers = [
            'Content-Type: application/json'
        ];
        $httpClient = new HttpClient($baseUrl, $headers);

        $data = [
            'code' => $code,
            'client_id' => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'redirect_uri' => $this->config['redirect_uri'],
            'grant_type' => 'authorization_code'
        ];
        $response = $httpClient->makeRequest('oauth2/token', $data);

        return $response;
    }

    /**
     * @throws OAuth2ConfigMissingParamException
     */
    private function validateConfig()
    {
        $requiredParams = ['client_id', 'client_secret', 'redirect_uri', 'scope'];

        foreach ($requiredParams as $requiredParam) {
            if (!array_key_exists($requiredParam, $this->config)) {
                throw new OAuth2ConfigMissingParamException($requiredParam);
            }
        }
    }
}
