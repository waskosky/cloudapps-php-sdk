<?php

namespace CloudPrinter\CloudApps\WebHook;

use CloudPrinter\CloudApps\Exception\WebHookApiKeyException;
use CloudPrinter\CloudApps\Http\Request;

/**
 * Class WebHookHandler
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 *
 * @method onItemShipped(callable $callBackFunction)
 * @method onItemError(callable $callBackFunction)
 * @method onCloudprinterOrderValidated(callable $callBackFunction)
 * @method onCloudprinterOrderCanceled(callable $callBackFunction)
 * @method onItemValidated(callable $callBackFunction)
 * @method onItemProduce(callable $callBackFunction)
 * @method onItemProduced(callable $callBackFunction)
 * @method onItemPacked(callable $callBackFunction)
 * @method onItemCanceled(callable $callBackFunction)
 * @method onAll(callable $callBackFunction)
 */
class WebHookHandler
{
    const ALL_SIGNALS = 'All';

    /** @var string */
    private $webHookApiKey;

    /**
     * WebHookHandler constructor.
     * @param $webHookApiKey
     */
    public function __construct($webHookApiKey)
    {
        $this->webHookApiKey = $webHookApiKey;
    }

    /**
     * Handle all possible signals.
     * @param $name
     * @param $arguments
     * @throws WebHookApiKeyException
     */
    public function __call($name, $arguments)
    {
        $signalName = preg_replace('/^on/', '', $name);
        $webHookData = $this->getWebHookData();

        if ($webHookData) {
            $this->validateWebHookData($webHookData);

            if (!empty($webHookData['type']) && in_array($signalName, [$webHookData['type'], self::ALL_SIGNALS])) {
                $arguments[0]($webHookData);
            }
        }
    }

    /**
     * Allows handle more than one signal types in one function.
     * @param array $signals
     * @param callable $handlerFunction
     * @throws WebHookApiKeyException
     */
    public function on(array $signals, callable $handlerFunction)
    {
        $webHookData = $this->getWebHookData();

        if ($webHookData) {
            $this->validateWebHookData($webHookData);

            if (in_array($webHookData['type'], $signals)) {
                $handlerFunction($webHookData);
            }
        }
    }

    /**
     * @param array $webHookData
     * @throws WebHookApiKeyException
     */
    private function validateWebHookData(array $webHookData)
    {
        if (empty($webHookData['apikey']) || $webHookData['apikey'] != $this->webHookApiKey) {
            throw new WebHookApiKeyException();
        }
    }

    /**
     * Reading HTTP request data from a JSON POST.
     * @return array
     */
    public function getWebHookData(): array
    {
        $request = new Request();

        return $request->getJsonPostData();
    }
}
