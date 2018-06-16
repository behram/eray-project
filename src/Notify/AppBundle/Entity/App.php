<?php

namespace Notify\AppBundle\Entity;

use EP\DisplayBundle\Entity\DisplayTrait;
use Notify\Common\Entity\GenericExtendedEntity;
use Notify\ProjectBundle\Entity\Project;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * App.
 */
class App extends GenericExtendedEntity
{
    use DisplayTrait;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $appName;

    /**
     * @var string
     * @Assert\Length(
     *      min = 8,
     *      max = 8,
     *      minMessage = "Your tracker hash must be at least {{ limit }} characters long",
     *      maxMessage = "Your tracker hash cannot be longer than {{ limit }} characters"
     * )
     */
    private $appHash;

    /**
     * @var string
     */
    private $language;

    /**
     * @var bool
     */
    private $isOnline;

    /**
     * @var string
     */
    private $runTime = 0;

    /**
     * @var Project
     */
    private $project;

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
     * Set appName.
     *
     * @param string $appName
     *
     * @return App
     */
    public function setAppName($appName)
    {
        $this->appName = $appName;

        return $this;
    }

    /**
     * Get appName.
     *
     * @return string
     */
    public function getAppName()
    {
        return $this->appName;
    }

    /**
     * Set appHash.
     *
     * @param string $appHash
     *
     * @return App
     */
    public function setAppHash($appHash)
    {
        $this->appHash = $appHash;

        return $this;
    }

    /**
     * Get appHash.
     *
     * @return string
     */
    public function getAppHash()
    {
        return $this->appHash;
    }

    /**
     * Set language.
     *
     * @param string $language
     *
     * @return App
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set isOnline.
     *
     * @param bool $isOnline
     *
     * @return App
     */
    public function setIsOnline($isOnline)
    {
        $this->isOnline = $isOnline;

        return $this;
    }

    /**
     * Get isOnline.
     *
     * @return bool
     */
    public function getIsOnline()
    {
        return $this->isOnline;
    }

    /**
     * Set runTime.
     *
     * @param string $runTime
     *
     * @return App
     */
    public function setRunTime($runTime)
    {
        $this->runTime = $runTime;

        return $this;
    }

    /**
     * Get runTime.
     *
     * @return string
     */
    public function getRunTime()
    {
        return $this->runTime;
    }

    /**
     * Set project.
     *
     * @param Project $project
     *
     * @return $this
     */
    public function setProject(Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project.
     *
     * @return Project
     */
    public function getProject()
    {
        return $this->project;
    }
}
