<?php

namespace Notify\UserBundle\Provider\Sms\Exception;

class SmsException extends \RuntimeException
{
    public function __construct($message = 'Sms delivery failed', \Exception $previous = null)
    {
        parent::__construct($message, 403, $previous);
    }
}
