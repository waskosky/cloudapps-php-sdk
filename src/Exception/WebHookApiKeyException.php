<?php

namespace CloudPrinter\CloudApps\Exception;

/**
 * Class WebHookApiKeyException
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class WebHookApiKeyException extends \Exception
{
    /**
     * WebHookApiKeyException constructor.
     */
    public function __construct()
    {
        $message = 'Web-hook api key is not valid.';
        parent::__construct($message);
    }
}
