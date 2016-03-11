<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DealerGroup
 */
class DealerGroup implements EntityInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $groupRef;

    /**
     * @var \DateTime
     */
    private $dateAdded;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $dealers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \IMS\CommonBundle\Entity\Account
     */
    private $account;

    /**
     * @var \IMS\CommonBundle\Entity\DealerGroup
     */
    private $parent;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dealers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return DealerGroup
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set groupRef
     *
     * @param string $groupRef
     * @return DealerGroup
     */
    public function setGroupRef($groupRef)
    {
        $this->groupRef = $groupRef;

        return $this;
    }

    /**
     * Get groupRef
     *
     * @return string 
     */
    public function getGroupRef()
    {
        return $this->groupRef;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return DealerGroup
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     * @return DealerGroup
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime 
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Add dealers
     *
     * @param \IMS\CommonBundle\Entity\Dealer $dealers
     * @return DealerGroup
     */
    public function addDealer(\IMS\CommonBundle\Entity\Dealer $dealers)
    {
        $this->dealers[] = $dealers;

        return $this;
    }

    /**
     * Remove dealers
     *
     * @param \IMS\CommonBundle\Entity\Dealer $dealers
     */
    public function removeDealer(\IMS\CommonBundle\Entity\Dealer $dealers)
    {
        $this->dealers->removeElement($dealers);
    }

    /**
     * Get dealers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDealers()
    {
        return $this->dealers;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $dealers
     * @return $this
     */
    public function setDealers($dealers)
    {
        $this->dealers = $dealers;

        return $this;
    }

    /**
     * Add children
     *
     * @param \IMS\CommonBundle\Entity\DealerGroup $children
     * @return DealerGroup
     */
    public function addChild(\IMS\CommonBundle\Entity\DealerGroup $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \IMS\CommonBundle\Entity\DealerGroup $children
     */
    public function removeChild(\IMS\CommonBundle\Entity\DealerGroup $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $children
     * @return $this
     */
    public function setChildren($children)
    {
        $this->children = $children;

        return $this;
    }

    /**
     * Set account
     *
     * @param \IMS\CommonBundle\Entity\Account $account
     * @return DealerGroup
     */
    public function setAccount(\IMS\CommonBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \IMS\CommonBundle\Entity\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set parent
     *
     * @param \IMS\CommonBundle\Entity\DealerGroup $parent
     * @return DealerGroup
     */
    public function setParent(\IMS\CommonBundle\Entity\DealerGroup $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \IMS\CommonBundle\Entity\DealerGroup 
     */
    public function getParent()
    {
        return $this->parent;
    }
}
