<?php
namespace KayStrobach\Faq\Domain\Model;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use Doctrine\Common\Collections\ArrayCollection;
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Category
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @ORM\OneToMany(mappedBy="category")
     * @var ArrayCollection<Answer>
     */
    protected $questions;

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
}
