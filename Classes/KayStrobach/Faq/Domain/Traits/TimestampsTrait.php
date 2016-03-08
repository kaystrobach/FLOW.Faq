<?php

namespace KayStrobach\Faq\Domain\Traits;

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

trait TimestampsTrait
{
    /**
     * @var \DateTime
     */
    protected $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(nullable=true)
     */
    protected $expirationDate;

    /**
     *
     */
    protected function initCreationDate() {
        $this->creationDate = new \DateTime('now');
    }

    /**
     * Returns the date on which this account has been created.
     *
     * @return \DateTime
     * @api
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Returns the date on which this account has expired or will expire. If no expiration date has been set, NULL
     * is returned.
     *
     * @return \DateTime
     * @api
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Sets the date on which this account will become inactive
     *
     * @param \DateTime $expirationDate
     * @return void
     * @api
     */
    public function setExpirationDate(\DateTime $expirationDate = null)
    {
        $this->expirationDate = $expirationDate;
    }

}