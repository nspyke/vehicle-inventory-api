<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * TrimMaterial
 */
class TrimMaterial implements EntityInterface, Translatable
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
    private $manufacturers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->manufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return TrimMaterial
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
     * @return TrimMaterial
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
     * @return TrimMaterial
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
     * Set status
     *
     * @param integer $status
     * @return TrimMaterial
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
     * @param \IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $manufacturerCodes
     * @return TrimMaterial
     */
    public function addManufacturerCode(\IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $manufacturerCodes)
    {
        $this->manufacturerCodes[] = $manufacturerCodes;

        return $this;
    }

    /**
     * Remove manufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $manufacturerCodes
     */
    public function removeManufacturerCode(\IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $manufacturerCodes)
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
     * Add manufacturers
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturers
     * @return TrimMaterial
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
     * @param \Doctrine\Common\Collections\Collection $manufacturers
     * @return $this
     */
    public function setManufacturers($manufacturers)
    {
        $this->manufacturers = $manufacturers;

        return $this;
    }

}
