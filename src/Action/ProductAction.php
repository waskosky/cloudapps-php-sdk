<?php

namespace CloudPrinter\CloudApps\Action;

use CloudPrinter\CloudApps\Http\Response;

/**
 * Class ProductAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class ProductAction extends BaseAction
{
    /**
     * @return Response
     */
    public function getList(): Response
    {
        $response = $this->httpClient->makeRequest('products', null);

        return $response;
    }

    /**
     * @param string $orderReference
     * @return Response
     */
    public function getInfo(string $orderReference): Response
    {
        $data = ['product_reference' => $orderReference];
        $response = $this->httpClient->makeRequest('products/info', $data);

        return $response;
    }
}
