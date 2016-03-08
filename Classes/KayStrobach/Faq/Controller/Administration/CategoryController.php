<?php

namespace KayStrobach\Faq\Controller\Administration;

use KayStrobach\Faq\Domain\Model\Category;
use KayStrobach\Faq\Domain\Repository\CategoryRepository;
use TYPO3\Flow\Annotations as Flow;

class CategoryController extends \TYPO3\Flow\Mvc\Controller\ActionController
{
    /**
     * @Flow\Inject()
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     *
     */
    public function indexAction() {
        $this->view->assign('categories', $this->categoryRepository->findAll());
    }

    /**
     *
     */
    public function newAction() {

    }

    /**
     * @param Category $category
     * @throws \TYPO3\Flow\Persistence\Exception\IllegalObjectTypeException
     */
    public function createAction(Category $category) {
        $this->categoryRepository->add($category);
        $this->redirect(
            'index'
        );
    }
}