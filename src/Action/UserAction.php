<?php

namespace CloudPrinter\CloudApps\Action;

use CloudPrinter\CloudApps\Http\Response;

/**
 * Class UserAction
 *
 * @copyright 2019 by CloudPrinter
 * @author    Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class UserAction extends BaseAction
{
    /**
     * Base url for CloudUser api.
     */
    const CLOUD_USER_URL = 'https://api.cloudprinter.com/clouduser/1.0/';

    /**
     * Get info about authorized user.
     * @return Response
     */
    public function getInfo(): Response
    {
        $this->httpClient->setBaseUrl(self::CLOUD_USER_URL);
        $response = $this->httpClient->makeRequest('info', null);

        return $response;
    }
}
