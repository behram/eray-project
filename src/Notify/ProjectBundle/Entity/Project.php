<?php

namespace Notify\ProjectBundle\Entity;

use APY\DataGridBundle\Grid\Mapping as GRID;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Notify\Common\Entity\GenericExtendedEntity;
use Notify\UserBundle\Entity\User;

/**
 * Project.
 *
 * @GRID\Source(columns="id,projectName,created,updated")
 */
class Project extends GenericExtendedEntity
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $projectName;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var Collection
     */
    private $schedules;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->schedules = new ArrayCollection();
    }

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
     * Set projectName.
     *
     * @param string $projectName
     *
     * @return Project
     */
    public function setProjectName($projectName)
    {
        $this->projectName = $projectName;

        return $this;
    }

    /**
     * Get projectName.
     *
     * @return string
     */
    public function getProjectName()
    {
        return $this->projectName;
    }

    /**
     * Set slug.
     *
     * @param string $slug
     *
     * @return Project
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set user.
     *
     * @param User $user
     *
     * @return Project
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        return $this->projectName;
    }
}
