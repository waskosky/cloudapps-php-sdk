<?php

namespace CloudPrinter\CloudApps\Client;

/**
 * Interface ClientInterface
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
interface ClientInterface
{
    /**
     * Get base CloudPrinter api url
     * @return string
     */
    public function getBaseUrl();

    /**
     * Get access token
     * @return string
     */
    public function getAccessToken();

    /**
     * Make simple request
     * @param string $url
     * @param array|null $data
     * @return mixed
     */
    public function makeRequest(string $url, array $data = null);
}
