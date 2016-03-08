<?php
namespace KayStrobach\Faq\Domain\Repository;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\QueryInterface;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class CategoryRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'title' => QueryInterface::ORDER_ASCENDING
    );
}
