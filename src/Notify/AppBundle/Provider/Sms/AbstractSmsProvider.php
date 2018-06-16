<?php

namespace Notify\AppBundle\Provider\Sms;

abstract class AbstractSmsProvider
{
    /**
     * @var String
     */
    protected $username;

    /**
     * @var String
     */
    protected $password;

    /**
     * @var String
     */
    protected $header;

    /**
     * @var array
     */
    protected $numbers = array();

    /**
     * @var String
     */
    protected $text;

    /**
     * Example : array(
     *              '90532999888777' => 'this is message for <somebody>',
     *              '90532999888777' => 'this is message for <somebody>'
     *           ).
     *
     * @var array
     */
    protected $messageBags = array();

    /**
     * @var bool
     */
    protected $isOnlySafeChars = false;

    /**
     * @param string $str
     *
     * @return string
     */
    private function toAscii($str)
    {
        setlocale(LC_ALL, 'en_US.UTF8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9~!@#$%^&*()`\[\]{};':,.\/<>?| ]/", '', $clean);

        return $clean;
    }

    /**
     * @param string $number
     *
     * @return string
     */
    public function normalizeNumber($number)
    {
        return $number;
    }

    /**
     * @param string $message
     *
     * @return string
     */
    public function normalizeText($message)
    {
        if ($this->isOnlySafeChars) {
            return $this->toAscii($message);
        }

        return $message;
    }

    /**
     * @param string $username
     * @param string $password
     */
    public function setAuth($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @param string $number
     */
    public function addNumber($number)
    {
        $this->numbers[] = $this->normalizeNumber($number);
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $this->normalizeText($text);
    }

    /**
     * @param array $messageBag array('90532999888777' => 'this is message for <somebody>')
     */
    public function addMessageBag($messageBag)
    {
        $number = $this->normalizeNumber(key($messageBag));
        $text = $this->normalizeText($messageBag[key($messageBag)]);
        $this->messageBags[$number] = $text;
    }

    /**
     * @return mixed
     */
    abstract public function sendSms();
}
