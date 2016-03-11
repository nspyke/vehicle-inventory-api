<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * Engine
 */
class Engine implements EntityInterface, Translatable
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
     * @var integer
     */
    private $cylinders;

    /**
     * @var integer
     */
    private $valves;

    /**
     * @var string
     */
    private $bhp;

    /**
     * @var integer
     */
    private $turbo;

    /**
     * @var integer
     */
    private $supercharger;

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
     * @var \IMS\CommonBundle\Entity\Fuel
     */
    private $fuel;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $manufacturers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $models;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->manufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->manufacturers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->models = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Engine
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
     * Set cylinders
     *
     * @param integer $cylinders
     * @return Engine
     */
    public function setCylinders($cylinders)
    {
        $this->cylinders = $cylinders;

        return $this;
    }

    /**
     * Get cylinders
     *
     * @return integer 
     */
    public function getCylinders()
    {
        return $this->cylinders;
    }

    /**
     * Set valves
     *
     * @param integer $valves
     * @return Engine
     */
    public function setValves($valves)
    {
        $this->valves = $valves;

        return $this;
    }

    /**
     * Get valves
     *
     * @return integer 
     */
    public function getValves()
    {
        return $this->valves;
    }

    /**
     * Set bhp
     *
     * @param string $bhp
     * @return Engine
     */
    public function setBhp($bhp)
    {
        $this->bhp = $bhp;

        return $this;
    }

    /**
     * Get bhp
     *
     * @return string 
     */
    public function getBhp()
    {
        return $this->bhp;
    }

    /**
     * Set turbo
     *
     * @param integer $turbo
     * @return Engine
     */
    public function setTurbo($turbo)
    {
        $this->turbo = $turbo;

        return $this;
    }

    /**
     * Get turbo
     *
     * @return integer 
     */
    public function getTurbo()
    {
        return $this->turbo;
    }

    /**
     * Set supercharger
     *
     * @param integer $supercharger
     * @return Engine
     */
    public function setSupercharger($supercharger)
    {
        $this->supercharger = $supercharger;

        return $this;
    }

    /**
     * Get supercharger
     *
     * @return integer 
     */
    public function getSupercharger()
    {
        return $this->supercharger;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Engine
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
     * @return Engine
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
     * @return Engine
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
     * @return Engine
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
     * @param \IMS\CommonBundle\Entity\EngineManufacturerCode $manufacturerCodes
     * @return Engine
     */
    public function addManufacturerCode(\IMS\CommonBundle\Entity\EngineManufacturerCode $manufacturerCodes)
    {
        $this->manufacturerCodes[] = $manufacturerCodes;

        return $this;
    }

    /**
     * Remove manufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\EngineManufacturerCode $manufacturerCodes
     */
    public function removeManufacturerCode(\IMS\CommonBundle\Entity\EngineManufacturerCode $manufacturerCodes)
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
     * Set fuel
     *
     * @param \IMS\CommonBundle\Entity\Fuel $fuel
     * @return Engine
     */
    public function setFuel(\IMS\CommonBundle\Entity\Fuel $fuel = null)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get fuel
     *
     * @return \IMS\CommonBundle\Entity\Fuel 
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Add manufacturers
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturers
     * @return Engine
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
     * Add models
     *
     * @param \IMS\CommonBundle\Entity\Model $models
     * @return Engine
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
     * @param \Doctrine\Common\Collections\Collection $manufacturerCodes
     * @return $this
     */
    public function setManufacturerCodes($manufacturerCodes)
    {
        $this->manufacturerCodes = $manufacturerCodes;

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

    /**
     * @param \Doctrine\Common\Collections\Collection $models
     * @return $this
     */
    public function setModels($models)
    {
        $this->models = $models;

        return $this;
    }
}
