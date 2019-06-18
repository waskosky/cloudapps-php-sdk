<?php

namespace CloudPrinter\CloudApps\Action;

use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Http\Response;
use CloudPrinter\CloudApps\Model\OrderQuote;

/**
 * Class PriceAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class PriceAction extends BaseAction
{
    /**
     * @param OrderQuote $orderQuote
     * @return Response
     * @throws ValidationException
     */
    public function lookup(OrderQuote $orderQuote): Response
    {
        $data = $orderQuote->toArray();
        $response = $this->httpClient->makeRequest('prices/lookup', $data);

        return $response;
    }
}
