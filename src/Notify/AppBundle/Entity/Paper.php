<?php

namespace Notify\AppBundle\Entity;

use EP\DisplayBundle\Entity\DisplayTrait;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Notify\ProjectBundle\Entity\Project;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ExclusionPolicy("all")
 * Paper
 */
class Paper
{
    use DisplayTrait;

    /**
     * @var int
     * @Expose
     */
    private $id;

    /**
     * @var string
     * @Expose
     */
    private $title;

    /**
     * @var string
     * @Expose
     */
    private $content;

    private $rate = 0;

    /**
     * @var \DateTime
     */
    private $created;

    /**
     * @var \DateTime
     */
    private $updated;

    /**
     * @var string
     */
    private $createdBy;

    /**
     * @var string
     */
    private $updatedBy;

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
     * Set paperName.
     *
     * @param string $paperName
     *
     * @return Paper
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get paperName.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set paperName.
     *
     * @param string $paperName
     *
     * @return Paper
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get paperName.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }


    /**
     * Set paperName.
     *
     * @param string $paperName
     *
     * @return Paper
     */
    public function setRate($rate = 0)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get paperName.
     *
     * @return string
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set paperHash.
     *
     * @param string $paperHash
     *
     * @return Paper
     */
    public function setPaperHash($paperHash)
    {
        $this->paperHash = $paperHash;

        return $this;
    }

    /**
     * Get paperHash.
     *
     * @return string
     */
    public function getPaperHash()
    {
        return $this->paperHash;
    }

    /**
     * Set language.
     *
     * @param string $language
     *
     * @return Paper
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
     * Set consoleLog.
     *
     * @param bool $consoleLog
     *
     * @return Paper
     */
    public function setConsoleLog($consoleLog)
    {
        $this->consoleLog = $consoleLog;

        return $this;
    }

    /**
     * Get consoleLog.
     *
     * @return bool
     */
    public function getConsoleLog()
    {
        return $this->consoleLog;
    }

    /**
     * Set domains.
     *
     * @param string $domains
     *
     * @return Paper
     */
    public function setDomains($domains)
    {
        $this->domains = $domains;

        return $this;
    }

    /**
     * Get domains.
     *
     * @return string
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * Set isOnline.
     *
     * @param bool $isOnline
     *
     * @return Paper
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
     * @return Paper
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
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Paper
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated.
     *
     * @param \DateTime $updated
     *
     * @return Paper
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set createdBy.
     *
     * @param string $createdBy
     *
     * @return Paper
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy.
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy.
     *
     * @param string $updatedBy
     *
     * @return Paper
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy.
     *
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set project.
     *
     * @param Project $project
     *
     * @return Paper
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
