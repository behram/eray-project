<?php

namespace Notify\AppBundle\Provider\Sms;

use Guzzle\Http\Client as Guzzle;
use Guzzle\Http\Message\Response;
use Notify\UserBundle\Provider\Sms\Event\SmsEvent;
use Notify\UserBundle\Provider\Sms\Event\SmsRollEvent;
use Notify\UserBundle\Provider\Sms\Exception\SmsException;
use Notify\UserBundle\Provider\Sms\SmsEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class DakikSmsAbstractProvider.
 */
class DakikSmsProvider extends AbstractSmsProvider
{
    /**
     * @var bool
     */
    protected $isOnlySafeChars = true;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var string
     */
    private $env;

    /**
     * @param string                   $username
     * @param string                   $password
     * @param string                   $header
     * @param EventDispatcherInterface $eventDispatcher
     * @param string                   $env
     */
    public function __construct($username = '', $password = '', $header = '', EventDispatcherInterface $eventDispatcher, $env = 'prod')
    {
        if (isset($username) && isset($password)) {
            $this->setAuth($username, $password);
        }
        if (isset($header)) {
            $this->setHeader($header);
        }
        $this->eventDispatcher = $eventDispatcher;
        $this->env = $env;
    }

    /**
     * {@inheritdoc}
     */
    public function normalizeNumber($number)
    {
        $number = ltrim($number, '0');
        $number = preg_replace('/[^0-9]/', '', $number);

        if (strlen($number) < 10) {
            return false;
        }
        $number = substr($number, -10);

        return $number;
    }

    /**
     * @return Response
     */
    public function sendSms()
    {
        if (count($this->messageBags) > 0) {
            return $this->sendMessageBagSms();
        }

        return $this->sendPlainSms();
    }

    /**
     * @return bool
     */
    private function sendMessageBagSms()
    {
        $xml = <<<EOT
<SMS>
    <oturum>
        <kullanici>{$this->username}</kullanici>
        <sifre>{$this->password}</sifre>
    </oturum>
    <baslik>{$this->header}</baslik>

EOT;
        foreach ($this->messageBags as $number => $text) {
            $text = $this->normalizeText($text);

            $xml .= <<<EOT
    <mesaj>
        <metin>{$text}</metin>
        <alici>{$number}</alici>
    </mesaj>

EOT;
        }
        $xml .= <<<EOT
</SMS>
EOT;
        try {
            $guzzle = new Guzzle();
            $request = $guzzle->post('http://www.dakiksms.com/api/xml_ozel_api.php', array('Content-Type' => 'text/xml'), $xml);
            $response = $request->send()->getBody(true);
        } catch (\Exception $e) {
            throw new SmsException();
        }

        $responseArr = explode('|', $response);
        if (count($responseArr) !== 2) {
            throw new SmsException('Sms delivery failed');
        } elseif ($responseArr[0] !== 'OK') {
            throw new SmsException('Sms delivery failed : '.$responseArr[1]);
        }
        $this->eventDispatcher->dispatch(SmsEvents::SMS_ROLL_SENT, new SmsRollEvent($this->messageBags, $responseArr[1]));

        return true;
    }

    /**
     * @return Response
     */
    private function sendPlainSms()
    {
        if (count($this->numbers) < 1) {
            throw new SmsException('SMS number(s) cannot found');
        }
        $numbers = implode(',', $this->numbers);
        $text = $this->normalizeText($this->text);
        $xml = <<<EOT
<SMS>
    <oturum>
        <kullanici>{$this->username}</kullanici>
        <sifre>{$this->password}</sifre>
    </oturum>
    <mesaj>
        <baslik>{$this->header}</baslik>
        <metin>{$text}</metin>
        <alicilar>{$numbers}</alicilar>
    </mesaj>
</SMS>
EOT;
        try {
            $guzzle = new Guzzle();
            $request = $guzzle->post('http://www.dakiksms.com/api/xml_api.php', array('Content-Type' => 'text/xml'), $xml);
            $response = 'OK|999999';
            if ($this->env === 'prod') {
                $response = $request->send()->getBody(true);
            }
        } catch (\Exception $e) {
            throw new SmsException();
        }
        $responseArr = explode('|', $response);
        if (count($responseArr) !== 2) {
            throw new SmsException('Sms delivery failed');
        } elseif ($responseArr[0] !== 'OK') {
            throw new SmsException('Sms delivery failed : '.$responseArr[1]);
        }

        $this->eventDispatcher->dispatch(SmsEvents::SMS_SENT, new SmsEvent($this->numbers, $this->text, $responseArr[1]));

        return true;
    }
}
