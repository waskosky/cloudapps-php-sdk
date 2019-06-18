<?php

namespace CloudPrinter\CloudApps\Exception;

/**
 * Class OAuth2ConfigMissingParamException
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
class OAuth2ConfigMissingParamException extends \Exception
{
    public function __construct(string $param)
    {
        $message = "The {$param} param is missing.";
        parent::__construct($message);
    }
}
