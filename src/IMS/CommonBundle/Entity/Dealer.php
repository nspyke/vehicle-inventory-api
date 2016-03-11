<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dealer
 */
class Dealer implements EntityInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $dealerRef;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $tradingTitle;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $publicUrl;

    /**
     * @var boolean
     */
    private $isApproved;

    /**
     * @var boolean
     */
    private $isVerified;

    /**
     * @var \DateTime
     */
    private $dateAdded;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    /**
     * @var string
     */
    private $addedBy;

    /**
     * @var string
     */
    private $updatedBy;

    /**
     * @var integer
     */
    private $dealerStatus;

    /**
     * @var integer
     */
    private $dealerType;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vehicles;

    /**
     * @var \IMS\CommonBundle\Entity\Account
     */
    private $account;

    /**
     * @var \IMS\CommonBundle\Entity\DealerGroup
     */
    private $dealerGroup;

    /**
     * @var \IMS\CommonBundle\Entity\Location
     */
    private $location;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $manufacturers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehicles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->manufacturers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dealerRef
     *
     * @param string $dealerRef
     * @return Dealer
     */
    public function setDealerRef($dealerRef)
    {
        $this->dealerRef = $dealerRef;

        return $this;
    }

    /**
     * Get dealerRef
     *
     * @return string 
     */
    public function getDealerRef()
    {
        return $this->dealerRef;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Dealer
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
     * Set tradingTitle
     *
     * @param string $tradingTitle
     * @return Dealer
     */
    public function setTradingTitle($tradingTitle)
    {
        $this->tradingTitle = $tradingTitle;

        return $this;
    }

    /**
     * Get tradingTitle
     *
     * @return string 
     */
    public function getTradingTitle()
    {
        return $this->tradingTitle;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Dealer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set publicUrl
     *
     * @param string $publicUrl
     * @return Dealer
     */
    public function setPublicUrl($publicUrl)
    {
        $this->publicUrl = $publicUrl;

        return $this;
    }

    /**
     * Get publicUrl
     *
     * @return string 
     */
    public function getPublicUrl()
    {
        return $this->publicUrl;
    }

    /**
     * Set isApproved
     *
     * @param boolean $isApproved
     * @return Dealer
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return boolean 
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * Set isVerified
     *
     * @param boolean $isVerified
     * @return Dealer
     */
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * Get isVerified
     *
     * @return boolean 
     */
    public function getIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Dealer
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
     * @return Dealer
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
     * Set addedBy
     *
     * @param string $addedBy
     * @return Dealer
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * Get addedBy
     *
     * @return string 
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     * @return Dealer
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return string 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set dealerStatus
     *
     * @param integer $dealerStatus
     * @return Dealer
     */
    public function setDealerStatus($dealerStatus)
    {
        $this->dealerStatus = $dealerStatus;

        return $this;
    }

    /**
     * Get dealerStatus
     *
     * @return integer 
     */
    public function getDealerStatus()
    {
        return $this->dealerStatus;
    }

    /**
     * Set dealerType
     *
     * @param integer $dealerType
     * @return Dealer
     */
    public function setDealerType($dealerType)
    {
        $this->dealerType = $dealerType;

        return $this;
    }

    /**
     * Get dealerType
     *
     * @return integer 
     */
    public function getDealerType()
    {
        return $this->dealerType;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Dealer
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Add vehicles
     *
     * @param \IMS\CommonBundle\Entity\Vehicle $vehicles
     * @return Dealer
     */
    public function addVehicle(\IMS\CommonBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles[] = $vehicles;

        return $this;
    }

    /**
     * Remove vehicles
     *
     * @param \IMS\CommonBundle\Entity\Vehicle $vehicles
     */
    public function removeVehicle(\IMS\CommonBundle\Entity\Vehicle $vehicles)
    {
        $this->vehicles->removeElement($vehicles);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $vehicles
     * @return $this
     */
    public function setVehicles($vehicles)
    {
        $this->vehicles = $vehicles;

        return $this;
    }

    /**
     * Set account
     *
     * @param \IMS\CommonBundle\Entity\Account $account
     * @return Dealer
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
     * Set dealerGroup
     *
     * @param \IMS\CommonBundle\Entity\DealerGroup $dealerGroup
     * @return Dealer
     */
    public function setDealerGroup(\IMS\CommonBundle\Entity\DealerGroup $dealerGroup = null)
    {
        $this->dealerGroup = $dealerGroup;

        return $this;
    }

    /**
     * Get dealerGroup
     *
     * @return \IMS\CommonBundle\Entity\DealerGroup 
     */
    public function getDealerGroup()
    {
        return $this->dealerGroup;
    }

    /**
     * Set location
     *
     * @param \IMS\CommonBundle\Entity\Location $location
     * @return Dealer
     */
    public function setLocation(\IMS\CommonBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \IMS\CommonBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add manufacturers
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturers
     * @return Dealer
     */
    public function addManufacturer(\IMS\CommonBundle\Entity\Manufacturer $manufacturers)
    {
        $this->manufacturers[] = $manufacturers;

        return $this;
    }

    /**
     * Remove manufacturers
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturers
     */
    public function removeManufacturer(\IMS\CommonBundle\Entity\Manufacturer $manufacturers)
    {
        $this->manufacturers->removeElement($manufacturers);
    }

    /**
     * Get manufacturers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getManufacturers()
    {
        return $this->manufacturers;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $manufacturers
     * @return $this
     */
    public function setManufacturers($manufacturers)
    {
        $this->manufacturers = $manufacturers;

        return $this;
    }
}
