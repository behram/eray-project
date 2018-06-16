<?php

namespace Notify\AppBundle\Entity;

use EP\DisplayBundle\Entity\DisplayTrait;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Notify\ProjectBundle\Entity\Project;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ExclusionPolicy("all")
 * Feedback
 */
class Feedback
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
    private $feedback;

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
     * Set feedbackName.
     *
     * @param string $feedbackName
     *
     * @return Feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;

        return $this;
    }

    /**
     * Get feedbackName.
     *
     * @return string
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * Set feedbackHash.
     *
     * @param string $feedbackHash
     *
     * @return Feedback
     */
    public function setFeedbackHash($feedbackHash)
    {
        $this->feedbackHash = $feedbackHash;

        return $this;
    }

    /**
     * Get feedbackHash.
     *
     * @return string
     */
    public function getFeedbackHash()
    {
        return $this->feedbackHash;
    }

    /**
     * Set language.
     *
     * @param string $language
     *
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
     * @return Feedback
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
