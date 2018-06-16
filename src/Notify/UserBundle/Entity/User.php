<?php

namespace Notify\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * User.
 */
class User extends BaseUser
{
    /**
     * default is turkey time offset.
     *
     * @var string
     */
    private $client_time_offset = -180;

    /**
     * @var string
     */
    protected $apiKey;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set client_time_offset.
     *
     * @param string $client_time_offset
     *
     * @return $this
     */
    public function setClientTimeOffset($client_time_offset)
    {
        $this->client_time_offset = $client_time_offset;

        return $this;
    }

    /**
     * Get client_time_offset.
     *
     * @return string
     */
    public function getClientTimeOffset()
    {
        return $this->client_time_offset;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
    /**
     * @param string $apiKey
     *
     * @return User
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Generates an API Key.
     */
    public function generateApiKey()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $apikey = '';
        for ($i = 0; $i < 64; ++$i) {
            $apikey .= $characters[rand(0, strlen($characters) - 1)];
        }
        $apikey = base64_encode(sha1(uniqid('ue'.rand(rand(), rand())).$apikey));
        $this->apiKey = $apikey;
    }
}
