<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * Variant
 */
class Variant implements EntityInterface, Translatable
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
     * @var \DateTime
     */
    private $dateAdded;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    /**
     * @var boolean
     */
    private $isVerified;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $manufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vehicles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $models;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $manufacturers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->manufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vehicles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->models = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Variant
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
     * @return Variant
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
     * @return Variant
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
     * Set isVerified
     *
     * @param boolean $isVerified
     * @return Variant
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
     * Set status
     *
     * @param integer $status
     * @return Variant
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
     * Add manufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\VariantManufacturerCode $manufacturerCodes
     * @return Variant
     */
    public function addManufacturerCode(\IMS\CommonBundle\Entity\VariantManufacturerCode $manufacturerCodes)
    {
        $this->manufacturerCodes[] = $manufacturerCodes;

        return $this;
    }

    /**
     * Remove manufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\VariantManufacturerCode $manufacturerCodes
     */
    public function removeManufacturerCode(\IMS\CommonBundle\Entity\VariantManufacturerCode $manufacturerCodes)
    {
        $this->manufacturerCodes->removeElement($manufacturerCodes);
    }

    /**
     * Get manufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getManufacturerCodes()
    {
        return $this->manufacturerCodes;
    }

    /**
     * Add vehicles
     *
     * @param \IMS\CommonBundle\Entity\Vehicle $vehicles
     * @return Variant
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
     * Add models
     *
     * @param \IMS\CommonBundle\Entity\Model $models
     * @return Variant
     */
    public function addModel(\IMS\CommonBundle\Entity\Model $models)
    {
        $this->models[] = $models;

        return $this;
    }

    /**
     * Remove models
     *
     * @param \IMS\CommonBundle\Entity\Model $models
     */
    public function removeModel(\IMS\CommonBundle\Entity\Model $models)
    {
        $this->models->removeElement($models);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * Add manufacturers
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturers
     * @return Variant
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
     * @param \Doctrine\Common\Collections\Collection $manufacturerCodes
     * @return $this
     */
    public function setManufacturerCodes($manufacturerCodes)
    {
        $this->manufacturerCodes = $manufacturerCodes;

        return $this;
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
     * @param \Doctrine\Common\Collections\Collection $models
     * @return $this
     */
    public function setModels($models)
    {
        $this->models = $models;

        return $this;
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
