<?php

namespace CloudPrinter\CloudApps\Action;

use CloudPrinter\CloudApps\Exception\ValidationException;
use CloudPrinter\CloudApps\Http\Response;
use CloudPrinter\CloudApps\Model\Order;
use CloudPrinter\CloudApps\Model\OrderQuote;

/**
 * Class OrderAction
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OrderAction extends BaseAction
{
    /**
     * @param Order $order
     * @return Response
     * @throws ValidationException
     */
    public function create(Order $order): Response
    {
        $data = $order->toArray();

        $response = $this->httpClient->makeRequest('orders/add', $data);

        return $response;
    }

    /**
     * @return Response
     */
    public function getList(): Response
    {
        $response = $this->httpClient->makeRequest('orders');

        return $response;
    }

    /**
     * @param string $orderReference
     * @return Response
     */
    public function getInfo(string $orderReference): Response
    {
        $data = ['reference' => $orderReference];
        $response = $this->httpClient->makeRequest('orders/info', $data);

        return $response;
    }

    /**
     * @param string $orderReference
     * @return Response
     */
    public function cancel(string $orderReference): Response
    {
        $data = ['reference' => $orderReference];
        $response = $this->httpClient->makeRequest('orders/cancel', $data);

        return $response;
    }

    /**
     * @param string $orderReference
     * @return Response
     */
    public function getLog(string $orderReference): Response
    {
        $data = ['reference' => $orderReference];
        $response = $this->httpClient->makeRequest('orders/log', $data);

        return $response;
    }

    /**
     * @param OrderQuote $orderQuote
     * @return Response
     * @throws ValidationException
     */
    public function quote(OrderQuote $orderQuote): Response
    {
        $data = $orderQuote->toArray();
        $response = $this->httpClient->makeRequest('orders/quote', $data);

        return $response;
    }

    /**
     * @param string $quoteHash
     * @return Response
     */
    public function quoteInfo(string $quoteHash): Response
    {
        $data = ['quote' => $quoteHash];
        $response = $this->httpClient->makeRequest('orders/quote/info', $data);

        return $response;
    }
}
