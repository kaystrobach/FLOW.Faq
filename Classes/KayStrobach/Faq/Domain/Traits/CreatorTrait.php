<?php

namespace KayStrobach\Faq\Domain\Traits;

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

trait CreatorTrait
{
    /**
     * @ORM\ManyToOne()
     * @var \TYPO3\Flow\Security\Account
     */
    protected $creator;

    /**
     * @Flow\Inject()
     * @Flow\Transient()
     * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
     */
    protected $authenticationManager;

    /**
     * @Flow\Inject()
     * @Flow\Transient()
     * @var \TYPO3\Party\Domain\Service\PartyService
     */
    protected $partyService;

    /**
     * Question constructor.
     */
    public function setCreatorFromSecurityContext()
    {
        if($this->authenticationManager !== null) {
            $this->creator = $this->authenticationManager->getSecurityContext()->getAccount();
        }
    }

    /**
     * @return \TYPO3\Flow\Security\Account
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param \TYPO3\Flow\Security\Account $creator
     */
    public function setCreator(\TYPO3\Flow\Security\Account $creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return null|\TYPO3\Party\Domain\Model\AbstractParty
     */
    public function getCreatorParty()
    {
        if(!$this->creator instanceof \TYPO3\Flow\Security\Account) {
            return null;
        }
        return $this->partyService->getAssignedPartyOfAccount($this->creator);
    }

}