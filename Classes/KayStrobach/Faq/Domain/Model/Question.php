<?php
namespace KayStrobach\Faq\Domain\Model;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use KayStrobach\Faq\Domain\Traits\RolesTrait;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Security\Account;

/**
 * @Flow\Entity
 */
class Question
{
    use RolesTrait;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    protected $question;

    /**
     * @ORM\ManyToOne()
     * @var Account
     */
    protected $creator;

    /**
     * @ORM\OneToMany(mappedBy="question")
     * @var ArrayCollection<Answer>
     */
    protected $answers;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var string
     */
    protected $category;

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
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * @return Account
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param Account $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return ArrayCollection
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * @param ArrayCollection $answers
     */
    public function setAnswers($answers)
    {
        $this->answers = $answers;
    }
}
