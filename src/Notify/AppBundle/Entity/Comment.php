<?php

namespace Notify\AppBundle\Entity;

use EP\DisplayBundle\Entity\DisplayTrait;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Notify\ProjectBundle\Entity\Project;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ExclusionPolicy("all")
 * Comment
 */
class Comment
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
    private $comment;

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
     * Set commentName.
     *
     * @param string $commentName
     *
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get commentName.
     *
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set commentHash.
     *
     * @param string $commentHash
     *
     * @return Comment
     */
    public function setCommentHash($commentHash)
    {
        $this->commentHash = $commentHash;

        return $this;
    }

    /**
     * Get commentHash.
     *
     * @return string
     */
    public function getCommentHash()
    {
        return $this->commentHash;
    }

    /**
     * Set language.
     *
     * @param string $language
     *
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
     * @return Comment
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
