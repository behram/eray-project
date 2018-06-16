<?php

namespace Notify\UserBundle\Provider\Sms\Event;

use Symfony\Component\EventDispatcher\Event;

class SmsEvent extends Event
{
    /**
     * @var array
     */
    private $numbers;

    /**
     * @var String
     */
    private $message;

    /**
     * @var Integer
     */
    private $smsId;

    public function __construct($numbers, $message, $smsId)
    {
        $this->numbers = $numbers;
        $this->message = $message;
        $this->smsId = $smsId;
    }

    /**
     * @return array
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return int
     */
    public function getSmsId()
    {
        return $this->smsId;
    }
}
