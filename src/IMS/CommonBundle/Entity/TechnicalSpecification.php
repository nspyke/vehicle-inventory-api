<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TechnicalSpecification
 */
class TechnicalSpecification implements EntityInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $modelYear;

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
     * @var \IMS\CommonBundle\Entity\TechnicalSpecificationData
     */
    private $technicalSpecificationData;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $manufacturer;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $model;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $engine;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $variant;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $wheelbase;

    /**
     * @var \IMS\CommonBundle\Entity\Bodystyle
     */
    private $bodystyle;

    /**
     * @var \IMS\CommonBundle\Entity\Transmission
     */
    private $transmission;


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
     * Set modelYear
     *
     * @param integer $modelYear
     * @return TechnicalSpecification
     */
    public function setModelYear($modelYear)
    {
        $this->modelYear = $modelYear;

        return $this;
    }

    /**
     * Get modelYear
     *
     * @return integer 
     */
    public function getModelYear()
    {
        return $this->modelYear;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return TechnicalSpecification
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
     * @return TechnicalSpecification
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
     * @return TechnicalSpecification
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
     * Set technicalSpecificationData
     *
     * @param \IMS\CommonBundle\Entity\TechnicalSpecificationData $technicalSpecificationData
     * @return TechnicalSpecification
     */
    public function setTechnicalSpecificationData(\IMS\CommonBundle\Entity\TechnicalSpecificationData $technicalSpecificationData = null)
    {
        $this->technicalSpecificationData = $technicalSpecificationData;

        return $this;
    }

    /**
     * Get technicalSpecificationData
     *
     * @return \IMS\CommonBundle\Entity\TechnicalSpecificationData 
     */
    public function getTechnicalSpecificationData()
    {
        return $this->technicalSpecificationData;
    }

    /**
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return TechnicalSpecification
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
     * Set model
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $model
     * @return TechnicalSpecification
     */
    public function setModel(\IMS\CommonBundle\Entity\Manufacturer $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \IMS\CommonBundle\Entity\Manufacturer 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set engine
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $engine
     * @return TechnicalSpecification
     */
    public function setEngine(\IMS\CommonBundle\Entity\Manufacturer $engine = null)
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Get engine
     *
     * @return \IMS\CommonBundle\Entity\Manufacturer 
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Set variant
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $variant
     * @return TechnicalSpecification
     */
    public function setVariant(\IMS\CommonBundle\Entity\Manufacturer $variant = null)
    {
        $this->variant = $variant;

        return $this;
    }

    /**
     * Get variant
     *
     * @return \IMS\CommonBundle\Entity\Manufacturer 
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * Set wheelbase
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $wheelbase
     * @return TechnicalSpecification
     */
    public function setWheelbase(\IMS\CommonBundle\Entity\Manufacturer $wheelbase = null)
    {
        $this->wheelbase = $wheelbase;

        return $this;
    }

    /**
     * Get wheelbase
     *
     * @return \IMS\CommonBundle\Entity\Manufacturer 
     */
    public function getWheelbase()
    {
        return $this->wheelbase;
    }

    /**
     * Set bodystyle
     *
     * @param \IMS\CommonBundle\Entity\Bodystyle $bodystyle
     * @return TechnicalSpecification
     */
    public function setBodystyle(\IMS\CommonBundle\Entity\Bodystyle $bodystyle = null)
    {
        $this->bodystyle = $bodystyle;

        return $this;
    }

    /**
     * Get bodystyle
     *
     * @return \IMS\CommonBundle\Entity\Bodystyle 
     */
    public function getBodystyle()
    {
        return $this->bodystyle;
    }

    /**
     * Set transmission
     *
     * @param \IMS\CommonBundle\Entity\Transmission $transmission
     * @return TechnicalSpecification
     */
    public function setTransmission(\IMS\CommonBundle\Entity\Transmission $transmission = null)
    {
        $this->transmission = $transmission;

        return $this;
    }

    /**
     * Get transmission
     *
     * @return \IMS\CommonBundle\Entity\Transmission 
     */
    public function getTransmission()
    {
        return $this->transmission;
    }
}
