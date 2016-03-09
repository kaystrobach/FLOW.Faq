<?php
namespace KayStrobach\Faq\Domain\Model;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use KayStrobach\Faq\Domain\Repository\AnswerRepository;
use KayStrobach\Faq\Domain\Traits\CreatorTrait;
use KayStrobach\Faq\Domain\Traits\RolesTrait;
use KayStrobach\Faq\Domain\Traits\TimestampsTrait;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Question
{
    use RolesTrait;
    use CreatorTrait;
    use TimestampsTrait;

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
     * @ORM\OneToMany(mappedBy="question", cascade={"all"}, orphanRemoval=true)
     * @ORM\OrderBy({"title" = "ASC"})
     * @var ArrayCollection<Answer>
     */
    protected $answers;

    /**
     * @ORM\ManyToOne()
     * @var Category
     */
    protected $category;

    /**
     * @Flow\Inject()
     * @var AnswerRepository
     */
    protected $answerRepository;

    /**
     * Question constructor.
     */
    public function __construct()
    {
        $this->setCreatorFromSecurityContext();
        $this->initCreationDate();
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

    /**
     * @param Answer $answer
     */
    public function removeAnswer(Answer $answer) {
        $this->answerRepository->remove($answer);
        $this->answers->removeElement($answer);
    }

    /**
     * @param Answer $answer
     */
    public function addAnswer(Answer $answer) {
        $this->answers->add($answer);
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }
}
