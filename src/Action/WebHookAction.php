<?php

namespace CloudPrinter\CloudApps\Action;

use CloudPrinter\CloudApps\Http\Response;

/**
 * Class WebHookAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class WebHookAction extends BaseAction
{
    /**
     * @param string $url
     * @return Response
     */
    public function subscribe(string $url): Response
    {
        $data = ['url' => $url];
        $response = $this->httpClient->makeRequest('cloudsignal/webhooks', $data);

        return $response;
    }

    /**
     * @param int $webHookId
     * @return Response
     */
    public function unSubscribe(int $webHookId): Response
    {
        $response = $this->httpClient->makeRequest('cloudsignal/webhooks/' . $webHookId, [], 'delete');

        return $response;
    }
}
