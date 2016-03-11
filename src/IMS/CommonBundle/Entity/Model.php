<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * Model
 */
class Model implements EntityInterface, Translatable
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
     * @var \IMS\CommonBundle\Entity\ModelGroup
     */
    private $modelGroup;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $manufacturer;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $engines;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $equipment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $variants;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->engines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->variants = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Model
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
     * @return Model
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
     * @return Model
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
     * @return Model
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
     * @return Model
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
     * Set modelGroup
     *
     * @param \IMS\CommonBundle\Entity\ModelGroup $modelGroup
     * @return Model
     */
    public function setModelGroup(\IMS\CommonBundle\Entity\ModelGroup $modelGroup = null)
    {
        $this->modelGroup = $modelGroup;

        return $this;
    }

    /**
     * Get modelGroup
     *
     * @return \IMS\CommonBundle\Entity\ModelGroup 
     */
    public function getModelGroup()
    {
        return $this->modelGroup;
    }

    /**
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return Model
     */
    public function setManufacturer(\IMS\CommonBundle\Entity\Manufacturer $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \IMS\CommonBundle\Entity\Manufacturer 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * Add engines
     *
     * @param \IMS\CommonBundle\Entity\Engine $engines
     * @return Model
     */
    public function addEngine(\IMS\CommonBundle\Entity\Engine $engines)
    {
        $this->engines[] = $engines;

        return $this;
    }

    /**
     * Remove engines
     *
     * @param \IMS\CommonBundle\Entity\Engine $engines
     */
    public function removeEngine(\IMS\CommonBundle\Entity\Engine $engines)
    {
        $this->engines->removeElement($engines);
    }

    /**
     * Get engines
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEngines()
    {
        return $this->engines;
    }

    /**
     * Add equipment
     *
     * @param \IMS\CommonBundle\Entity\Equipment $equipment
     * @return Model
     */
    public function addEquipment(\IMS\CommonBundle\Entity\Equipment $equipment)
    {
        $this->equipment[] = $equipment;

        return $this;
    }

    /**
     * Remove equipment
     *
     * @param \IMS\CommonBundle\Entity\Equipment $equipment
     */
    public function removeEquipment(\IMS\CommonBundle\Entity\Equipment $equipment)
    {
        $this->equipment->removeElement($equipment);
    }

    /**
     * Get equipment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipment()
    {
        return $this->equipment;
    }

    /**
     * Add variants
     *
     * @param \IMS\CommonBundle\Entity\Variant $variants
     * @return Model
     */
    public function addVariant(\IMS\CommonBundle\Entity\Variant $variants)
    {
        $this->variants[] = $variants;

        return $this;
    }

    /**
     * Remove variants
     *
     * @param \IMS\CommonBundle\Entity\Variant $variants
     */
    public function removeVariant(\IMS\CommonBundle\Entity\Variant $variants)
    {
        $this->variants->removeElement($variants);
    }

    /**
     * Get variants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $engines
     * @return $this
     */
    public function setEngines($engines)
    {
        $this->engines = $engines;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $equipment
     * @return $this
     */
    public function setEquipment($equipment)
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $variants
     * @return $this
     */
    public function setVariants($variants)
    {
        $this->variants = $variants;

        return $this;
    }
}
