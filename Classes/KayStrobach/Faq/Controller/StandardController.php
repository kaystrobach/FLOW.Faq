<?php
namespace KayStrobach\Faq\Controller;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use KayStrobach\Faq\Domain\Model\Question;
use KayStrobach\Faq\Domain\Repository\QuestionRepository;
use TYPO3\Flow\Annotations as Flow;

class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController
{

    /**
     * @Flow\Inject()
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     * @return void
     */
    public function indexAction()
    {
        $this->view->assign('questions', $this->questionRepository->findAll());
    }

    /**
     * @param Question $question
     */
    public function showAction(Question $question) {
        $this->view->assign('question', $question);
    }
}
