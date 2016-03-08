<?php
namespace KayStrobach\Faq\Domain\Model;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use KayStrobach\Faq\Domain\Traits\CreatorTrait;
use KayStrobach\Faq\Domain\Traits\RolesTrait;
use KayStrobach\Faq\Domain\Traits\TimestampsTrait;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Answer
{
    use RolesTrait;
    use CreatorTrait;
    use TimestampsTrait;

    /**
     * @ORM\ManyToOne(inversedBy="answers")
     * @var Question
     */
    protected $question;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    protected $answer;

    public function __construct()
    {
        $this->initCreationDate();
    }

    /**
     * @return Question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param Question $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }
}
