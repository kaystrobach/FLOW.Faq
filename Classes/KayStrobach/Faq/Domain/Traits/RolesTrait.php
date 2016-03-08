<?php
namespace KayStrobach\Faq\Domain\Traits;

/*
 * This file is part of the KayStrobach.Faq package.
 */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Security\Policy\Role;

trait RolesTrait
{
    /**
     * @var array of strings
     * @ORM\Column(type="simple_array", nullable=true)
     */
    protected $roleIdentifiers = array();

    /**
     * @Flow\Transient
     * @var array<\TYPO3\Flow\Security\Policy\Role>
     */
    protected $roles;

    /**
     * @Flow\Inject
     * @var \TYPO3\Flow\Security\Policy\PolicyService
     */
    protected $policyService;

    /**
     * Initializes the roles field by fetching the role objects referenced by the roleIdentifiers
     *
     * @return void
     */
    protected function initializeRoles()
    {
        if ($this->roles !== null) {
            return;
        }
        $this->roles = array();
        foreach ($this->roleIdentifiers as $key => $roleIdentifier) {
            // check for and clean up roles no longer available
            if ($this->policyService->hasRole($roleIdentifier)) {
                $this->roles[$roleIdentifier] = $this->policyService->getRole($roleIdentifier);
            } else {
                unset($this->roleIdentifiers[$key]);
            }
        }
    }

    /**
     * Returns the roles this account has assigned
     *
     * @return array<\TYPO3\Flow\Security\Policy\Role> The assigned roles, indexed by role identifier
     * @api
     */
    public function getRoles()
    {
        $this->initializeRoles();
        return $this->roles;
    }

    /**
     * Sets the roles for this account
     *
     * @param array<\TYPO3\Flow\Security\Policy\Role> $roles An array of \TYPO3\Flow\Security\Policy\Role objects
     * @return void
     * @throws \InvalidArgumentException
     * @api
     */
    public function setRoles(array $roles)
    {
        $this->roleIdentifiers = array();
        $this->roles = array();
        foreach ($roles as $role) {
            if (!$role instanceof \TYPO3\Flow\Security\Policy\Role) {
                throw new \InvalidArgumentException(sprintf('setRoles() only accepts an array of \TYPO3\Flow\Security\Policy\Role instances, given: "%s"', gettype($role)), 1397125997);
            }
            $this->addRole($role);
        }
    }

    /**
     * Return if the account has a certain role
     *
     * @param \TYPO3\Flow\Security\Policy\Role $role
     * @return boolean
     * @api
     */
    public function hasRole(\TYPO3\Flow\Security\Policy\Role $role)
    {
        $this->initializeRoles();
        return array_key_exists($role->getIdentifier(), $this->roles);
    }

    /**
     * Adds a role to this account
     *
     * @param \TYPO3\Flow\Security\Policy\Role $role
     * @return void
     * @throws \InvalidArgumentException
     * @api
     */
    public function addRole(\TYPO3\Flow\Security\Policy\Role $role)
    {
        if ($role->isAbstract()) {
            throw new \InvalidArgumentException(sprintf('Abstract roles can\'t be assigned to accounts directly, but the role "%s" is marked abstract', $role->getIdentifier()), 1399900657);
        }
        $this->initializeRoles();
        if (!$this->hasRole($role)) {
            $roleIdentifier = $role->getIdentifier();
            $this->roleIdentifiers[] = $roleIdentifier;
            $this->roles[$roleIdentifier] = $role;
        }
    }

    /**
     * Removes a role from this account
     *
     * @param \TYPO3\Flow\Security\Policy\Role $role
     * @return void
     * @api
     */
    public function removeRole(\TYPO3\Flow\Security\Policy\Role $role)
    {
        $this->initializeRoles();
        if ($this->hasRole($role)) {
            $roleIdentifier = $role->getIdentifier();
            unset($this->roles[$roleIdentifier]);
            $identifierIndex = array_search($roleIdentifier, $this->roleIdentifiers);
            unset($this->roleIdentifiers[$identifierIndex]);
        }
    }
}