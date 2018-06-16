<?php

namespace Notify\AppBundle\Entity;

use Notify\Common\Entity\GenericExtendedEntity;

/**
 * RegistrationId.
 */
class RegistrationId extends GenericExtendedEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $registrationId;

    /**
     * @var string
     */
    private $clientIp;

    /**
     * @var \Notify\AppBundle\Entity\App
     */
    private $app;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set registrationId.
     *
     * @param string $registrationId
     *
     * @return RegistrationId
     */
    public function setRegistrationId($registrationId)
    {
        $this->registrationId = $registrationId;

        return $this;
    }

    /**
     * Get registrationId.
     *
     * @return string
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }

    /**
     * Set clientIp.
     *
     * @param string $clientIp
     *
     * @return RegistrationId
     */
    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;

        return $this;
    }

    /**
     * Get clientIp.
     *
     * @return string
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * Set app.
     *
     * @param App $app
     *
     * @return RegistrationId
     */
    public function setApp(App $app = null)
    {
        $this->app = $app;

        return $this;
    }

    /**
     * Get app.
     *
     * @return App
     */
    public function getApp()
    {
        return $this->app;
    }
}
