<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Account
 */
class Account implements EntityInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $ref;

    /**
     * @var string
     */
    private $name;

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
     * Constructor
     */
    public function __construct()
    {
        $this->dealers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set ref
     *
     * @param string $ref
     * @return Account
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string 
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Account
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
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Account
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
     * @return Account
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
     * @return Account
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
}
