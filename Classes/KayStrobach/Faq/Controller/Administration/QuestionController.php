<?php

namespace KayStrobach\Faq\Controller\Administration;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use KayStrobach\Faq\Domain\Model\Answer;
use KayStrobach\Faq\Domain\Model\Question;
use KayStrobach\Faq\Domain\Repository\QuestionRepository;
use TYPO3\Flow\Annotations as Flow;


class QuestionController extends \TYPO3\Flow\Mvc\Controller\ActionController
{
    /**
     * @Flow\Inject()
     * @var QuestionRepository
     */
    protected $questionRepository;

    /**
     *
     */
    public function newAction() {

    }

    /**
     * @param Question $question
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function createAction(Question $question) {
        $this->questionRepository->add($question);
        $this->redirect(
            'edit',
            null,
            null,
            array(
                'question' => $question
            )
        );
    }

    /**
     * @param Question $question
     */
    public function editAction(Question $question) {
        $this->view->assign('question', $question);
    }

    /**
     * @param Question $question
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function updateAction(Question $question) {
        /** @var Answer $answer */
        foreach($question->getAnswers() as $answer) {
            if(($answer->getTitle() === '') && ($answer->getAnswer() === '')) {
                $question->removeAnswer($answer);
            }
        }
        $this->questionRepository->update($question);
        $this->redirect(
            'edit',
            null,
            null,
            array(
                'question' => $question
            )
        );
    }
}