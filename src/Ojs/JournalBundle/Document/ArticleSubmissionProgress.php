<?php

namespace Ojs\JournalBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * This collection holds resumable article submission data
 * @MongoDb\Document(collection="article_submission_progress")
 */
class ArticleSubmissionProgress
{

    /**
     * @MongoDb\Id
     */
    protected $id;

    /**
     * @MongoDb\Int
     */
    protected $current_step;

    /**
     * @MongoDB\Date
     */
    protected $started_date;

    /**
     * @MongoDB\Date
     */
    protected $last_resume_date;

    /** @MongoDb\Int @MongoDb\Index() */
    protected $userId;

    /** @MongoDb\Int @MongoDb\Index() */
    protected $article_id;

    /**
     * authors
     * @MongoDB\Hash
     */
    protected $authors;

    /**
     * @MongoDB\Hash
     */
    protected $citatoins;

    /**
     * @MongoDB\Hash
     */
    protected $files;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set currentStep
     *
     * @param int $currentStep
     * @return self
     */
    public function setCurrentStep($currentStep)
    {
        $this->current_step = $currentStep;
        return $this;
    }

    /**
     * Get currentStep
     *
     * @return int $currentStep
     */
    public function getCurrentStep()
    {
        return $this->current_step;
    }

    /**
     * Set startedDate
     *
     * @param date $startedDate
     * @return self
     */
    public function setStartedDate($startedDate)
    {
        $this->started_date = $startedDate;
        return $this;
    }

    /**
     * Get startedDate
     *
     * @return date $startedDate
     */
    public function getStartedDate()
    {
        return $this->started_date;
    }

    /**
     * Set lastResumeDate
     *
     * @param date $lastResumeDate
     * @return self
     */
    public function setLastResumeDate($lastResumeDate)
    {
        $this->last_resume_date = $lastResumeDate;
        return $this;
    }

    /**
     * Get lastResumeDate
     *
     * @return date $lastResumeDate
     */
    public function getLastResumeDate()
    {
        return $this->last_resume_date;
    }

    /**
     * Set userId
     *
     * @param int $userId
     * @return self
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get userId
     *
     * @return int $userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set articleId
     *
     * @param int $articleId
     * @return self
     */
    public function setArticleId($articleId)
    {
        $this->article_id = $articleId;
        return $this;
    }

    /**
     * Get articleId
     *
     * @return int $articleId
     */
    public function getArticleId()
    {
        return $this->article_id;
    }

    /**
     * Set authors
     *
     * @param hash $authors
     * @return self
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
        return $this;
    }

    /**
     * Get authors
     *
     * @return hash $authors
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * Set citatoins
     *
     * @param hash $citatoins
     * @return self
     */
    public function setCitatoins($citatoins)
    {
        $this->citatoins = $citatoins;
        return $this;
    }

    /**
     * Get citatoins
     *
     * @return hash $citatoins
     */
    public function getCitatoins()
    {
        return $this->citatoins;
    }

    /**
     * Set files
     *
     * @param hash $files
     * @return self
     */
    public function setFiles($files)
    {
        $this->files = $files;
        return $this;
    }

    /**
     * Get files
     *
     * @return hash $files
     */
    public function getFiles()
    {
        return $this->files;
    }

}