<?php

namespace Notify\Common\Entity;

use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * @ExclusionPolicy("all")
 * GenericExtendedEntity
 */
class GenericExtendedEntity
{
    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    /**
     * @var \DateTime
     */
    protected $contentChanged;

    /**
     * @var String
     */
    protected $createdBy;

    /**
     * @var String
     */
    protected $updatedBy;

    public function __construct()
    {
        php_sapi_name() == 'cli' && $this->createdBy = '';
        php_sapi_name() == 'cli' && $this->updatedBy = '';
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getContentChanged()
    {
        return $this->contentChanged;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;
    }
}
