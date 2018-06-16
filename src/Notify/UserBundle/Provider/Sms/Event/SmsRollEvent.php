<?php

namespace Notify\UserBundle\Provider\Sms\Event;

use Symfony\Component\EventDispatcher\Event;

class SmsRollEvent extends Event
{
    /**
     * @var array
     */
    private $messageBag;

    /**
     * @var int
     */
    private $smsId;

    /**
     * @param array $messageBag
     * @param int   $smsId
     */
    public function __construct($messageBag, $smsId)
    {
        $this->messageBag = $messageBag;
        $this->smsId = $smsId;
    }

    /**
     * @return array
     */
    public function getMessageBag()
    {
        return $this->messageBag;
    }
    /**
     * @return int
     */
    public function getSmsId()
    {
        return $this->smsId;
    }
}
