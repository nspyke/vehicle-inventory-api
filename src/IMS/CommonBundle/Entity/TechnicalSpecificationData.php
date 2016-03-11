<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TechnicalSpecificationData
 */
class TechnicalSpecificationData
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $engineCylinder;

    /**
     * @var string
     */
    private $maxPower;

    /**
     * @var string
     */
    private $maxTorque;

    /**
     * @var string
     */
    private $acceleration;

    /**
     * @var string
     */
    private $maxSpeed;

    /**
     * @var string
     */
    private $fuelEconomyOne;

    /**
     * @var string
     */
    private $fuelEconomyTwo;

    /**
     * @var string
     */
    private $fuelEconomyThree;

    /**
     * @var string
     */
    private $fuelTankCapacity;

    /**
     * @var string
     */
    private $co2Emissions;

    /**
     * @var string
     */
    private $vehicleTaxBand;

    /**
     * @var string
     */
    private $vehicleTaxPrice;

    /**
     * @var string
     */
    private $length;

    /**
     * @var string
     */
    private $width;

    /**
     * @var string
     */
    private $height;

    /**
     * @var string
     */
    private $wheelBase;

    /**
     * @var string
     */
    private $loadspaceWidth;

    /**
     * @var string
     */
    private $loadspaceVolume;

    /**
     * @var string
     */
    private $vehicleWeight;

    /**
     * @var string
     */
    private $towingBrakedTrailer;

    /**
     * @var string
     */
    private $towingUnbrakedTrailer;

    /**
     * @var string
     */
    private $turningCircle;

    /**
     * @var string
     */
    private $groundClearance;

    /**
     * @var string
     */
    private $approachAngle;

    /**
     * @var string
     */
    private $rampBreakoverAngle;

    /**
     * @var string
     */
    private $departureAngle;

    /**
     * @var string
     */
    private $wadingDepth;

    /**
     * @var integer
     */
    private $status;

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
    private $technicalSpecifications;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->technicalSpecifications = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set engineCylinder
     *
     * @param string $engineCylinder
     * @return TechnicalSpecificationData
     */
    public function setEngineCylinder($engineCylinder)
    {
        $this->engineCylinder = $engineCylinder;

        return $this;
    }

    /**
     * Get engineCylinder
     *
     * @return string 
     */
    public function getEngineCylinder()
    {
        return $this->engineCylinder;
    }

    /**
     * Set maxPower
     *
     * @param string $maxPower
     * @return TechnicalSpecificationData
     */
    public function setMaxPower($maxPower)
    {
        $this->maxPower = $maxPower;

        return $this;
    }

    /**
     * Get maxPower
     *
     * @return string 
     */
    public function getMaxPower()
    {
        return $this->maxPower;
    }

    /**
     * Set maxTorque
     *
     * @param string $maxTorque
     * @return TechnicalSpecificationData
     */
    public function setMaxTorque($maxTorque)
    {
        $this->maxTorque = $maxTorque;

        return $this;
    }

    /**
     * Get maxTorque
     *
     * @return string 
     */
    public function getMaxTorque()
    {
        return $this->maxTorque;
    }

    /**
     * Set acceleration
     *
     * @param string $acceleration
     * @return TechnicalSpecificationData
     */
    public function setAcceleration($acceleration)
    {
        $this->acceleration = $acceleration;

        return $this;
    }

    /**
     * Get acceleration
     *
     * @return string 
     */
    public function getAcceleration()
    {
        return $this->acceleration;
    }

    /**
     * Set maxSpeed
     *
     * @param string $maxSpeed
     * @return TechnicalSpecificationData
     */
    public function setMaxSpeed($maxSpeed)
    {
        $this->maxSpeed = $maxSpeed;

        return $this;
    }

    /**
     * Get maxSpeed
     *
     * @return string 
     */
    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    /**
     * Set fuelEconomyOne
     *
     * @param string $fuelEconomyOne
     * @return TechnicalSpecificationData
     */
    public function setFuelEconomyOne($fuelEconomyOne)
    {
        $this->fuelEconomyOne = $fuelEconomyOne;

        return $this;
    }

    /**
     * Get fuelEconomyOne
     *
     * @return string 
     */
    public function getFuelEconomyOne()
    {
        return $this->fuelEconomyOne;
    }

    /**
     * Set fuelEconomyTwo
     *
     * @param string $fuelEconomyTwo
     * @return TechnicalSpecificationData
     */
    public function setFuelEconomyTwo($fuelEconomyTwo)
    {
        $this->fuelEconomyTwo = $fuelEconomyTwo;

        return $this;
    }

    /**
     * Get fuelEconomyTwo
     *
     * @return string 
     */
    public function getFuelEconomyTwo()
    {
        return $this->fuelEconomyTwo;
    }

    /**
     * Set fuelEconomyThree
     *
     * @param string $fuelEconomyThree
     * @return TechnicalSpecificationData
     */
    public function setFuelEconomyThree($fuelEconomyThree)
    {
        $this->fuelEconomyThree = $fuelEconomyThree;

        return $this;
    }

    /**
     * Get fuelEconomyThree
     *
     * @return string 
     */
    public function getFuelEconomyThree()
    {
        return $this->fuelEconomyThree;
    }

    /**
     * Set fuelTankCapacity
     *
     * @param string $fuelTankCapacity
     * @return TechnicalSpecificationData
     */
    public function setFuelTankCapacity($fuelTankCapacity)
    {
        $this->fuelTankCapacity = $fuelTankCapacity;

        return $this;
    }

    /**
     * Get fuelTankCapacity
     *
     * @return string 
     */
    public function getFuelTankCapacity()
    {
        return $this->fuelTankCapacity;
    }

    /**
     * Set co2Emissions
     *
     * @param string $co2Emissions
     * @return TechnicalSpecificationData
     */
    public function setCo2Emissions($co2Emissions)
    {
        $this->co2Emissions = $co2Emissions;

        return $this;
    }

    /**
     * Get co2Emissions
     *
     * @return string 
     */
    public function getCo2Emissions()
    {
        return $this->co2Emissions;
    }

    /**
     * Set vehicleTaxBand
     *
     * @param string $vehicleTaxBand
     * @return TechnicalSpecificationData
     */
    public function setVehicleTaxBand($vehicleTaxBand)
    {
        $this->vehicleTaxBand = $vehicleTaxBand;

        return $this;
    }

    /**
     * Get vehicleTaxBand
     *
     * @return string 
     */
    public function getVehicleTaxBand()
    {
        return $this->vehicleTaxBand;
    }

    /**
     * Set vehicleTaxPrice
     *
     * @param string $vehicleTaxPrice
     * @return TechnicalSpecificationData
     */
    public function setVehicleTaxPrice($vehicleTaxPrice)
    {
        $this->vehicleTaxPrice = $vehicleTaxPrice;

        return $this;
    }

    /**
     * Get vehicleTaxPrice
     *
     * @return string 
     */
    public function getVehicleTaxPrice()
    {
        return $this->vehicleTaxPrice;
    }

    /**
     * Set length
     *
     * @param string $length
     * @return TechnicalSpecificationData
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return string 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set width
     *
     * @param string $width
     * @return TechnicalSpecificationData
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get width
     *
     * @return string 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return TechnicalSpecificationData
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return string 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set wheelBase
     *
     * @param string $wheelBase
     * @return TechnicalSpecificationData
     */
    public function setWheelBase($wheelBase)
    {
        $this->wheelBase = $wheelBase;

        return $this;
    }

    /**
     * Get wheelBase
     *
     * @return string 
     */
    public function getWheelBase()
    {
        return $this->wheelBase;
    }

    /**
     * Set loadspaceWidth
     *
     * @param string $loadspaceWidth
     * @return TechnicalSpecificationData
     */
    public function setLoadspaceWidth($loadspaceWidth)
    {
        $this->loadspaceWidth = $loadspaceWidth;

        return $this;
    }

    /**
     * Get loadspaceWidth
     *
     * @return string 
     */
    public function getLoadspaceWidth()
    {
        return $this->loadspaceWidth;
    }

    /**
     * Set loadspaceVolume
     *
     * @param string $loadspaceVolume
     * @return TechnicalSpecificationData
     */
    public function setLoadspaceVolume($loadspaceVolume)
    {
        $this->loadspaceVolume = $loadspaceVolume;

        return $this;
    }

    /**
     * Get loadspaceVolume
     *
     * @return string 
     */
    public function getLoadspaceVolume()
    {
        return $this->loadspaceVolume;
    }

    /**
     * Set vehicleWeight
     *
     * @param string $vehicleWeight
     * @return TechnicalSpecificationData
     */
    public function setVehicleWeight($vehicleWeight)
    {
        $this->vehicleWeight = $vehicleWeight;

        return $this;
    }

    /**
     * Get vehicleWeight
     *
     * @return string 
     */
    public function getVehicleWeight()
    {
        return $this->vehicleWeight;
    }

    /**
     * Set towingBrakedTrailer
     *
     * @param string $towingBrakedTrailer
     * @return TechnicalSpecificationData
     */
    public function setTowingBrakedTrailer($towingBrakedTrailer)
    {
        $this->towingBrakedTrailer = $towingBrakedTrailer;

        return $this;
    }

    /**
     * Get towingBrakedTrailer
     *
     * @return string 
     */
    public function getTowingBrakedTrailer()
    {
        return $this->towingBrakedTrailer;
    }

    /**
     * Set towingUnbrakedTrailer
     *
     * @param string $towingUnbrakedTrailer
     * @return TechnicalSpecificationData
     */
    public function setTowingUnbrakedTrailer($towingUnbrakedTrailer)
    {
        $this->towingUnbrakedTrailer = $towingUnbrakedTrailer;

        return $this;
    }

    /**
     * Get towingUnbrakedTrailer
     *
     * @return string 
     */
    public function getTowingUnbrakedTrailer()
    {
        return $this->towingUnbrakedTrailer;
    }

    /**
     * Set turningCircle
     *
     * @param string $turningCircle
     * @return TechnicalSpecificationData
     */
    public function setTurningCircle($turningCircle)
    {
        $this->turningCircle = $turningCircle;

        return $this;
    }

    /**
     * Get turningCircle
     *
     * @return string 
     */
    public function getTurningCircle()
    {
        return $this->turningCircle;
    }

    /**
     * Set groundClearance
     *
     * @param string $groundClearance
     * @return TechnicalSpecificationData
     */
    public function setGroundClearance($groundClearance)
    {
        $this->groundClearance = $groundClearance;

        return $this;
    }

    /**
     * Get groundClearance
     *
     * @return string 
     */
    public function getGroundClearance()
    {
        return $this->groundClearance;
    }

    /**
     * Set approachAngle
     *
     * @param string $approachAngle
     * @return TechnicalSpecificationData
     */
    public function setApproachAngle($approachAngle)
    {
        $this->approachAngle = $approachAngle;

        return $this;
    }

    /**
     * Get approachAngle
     *
     * @return string 
     */
    public function getApproachAngle()
    {
        return $this->approachAngle;
    }

    /**
     * Set rampBreakoverAngle
     *
     * @param string $rampBreakoverAngle
     * @return TechnicalSpecificationData
     */
    public function setRampBreakoverAngle($rampBreakoverAngle)
    {
        $this->rampBreakoverAngle = $rampBreakoverAngle;

        return $this;
    }

    /**
     * Get rampBreakoverAngle
     *
     * @return string 
     */
    public function getRampBreakoverAngle()
    {
        return $this->rampBreakoverAngle;
    }

    /**
     * Set departureAngle
     *
     * @param string $departureAngle
     * @return TechnicalSpecificationData
     */
    public function setDepartureAngle($departureAngle)
    {
        $this->departureAngle = $departureAngle;

        return $this;
    }

    /**
     * Get departureAngle
     *
     * @return string 
     */
    public function getDepartureAngle()
    {
        return $this->departureAngle;
    }

    /**
     * Set wadingDepth
     *
     * @param string $wadingDepth
     * @return TechnicalSpecificationData
     */
    public function setWadingDepth($wadingDepth)
    {
        $this->wadingDepth = $wadingDepth;

        return $this;
    }

    /**
     * Get wadingDepth
     *
     * @return string 
     */
    public function getWadingDepth()
    {
        return $this->wadingDepth;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return TechnicalSpecificationData
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
     * @return TechnicalSpecificationData
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
     * @return TechnicalSpecificationData
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
     * Add technicalSpecifications
     *
     * @param \IMS\CommonBundle\Entity\TechnicalSpecification $technicalSpecifications
     * @return TechnicalSpecificationData
     */
    public function addTechnicalSpecification(\IMS\CommonBundle\Entity\TechnicalSpecification $technicalSpecifications)
    {
        $this->technicalSpecifications[] = $technicalSpecifications;

        return $this;
    }

    /**
     * Remove technicalSpecifications
     *
     * @param \IMS\CommonBundle\Entity\TechnicalSpecification $technicalSpecifications
     */
    public function removeTechnicalSpecification(\IMS\CommonBundle\Entity\TechnicalSpecification $technicalSpecifications)
    {
        $this->technicalSpecifications->removeElement($technicalSpecifications);
    }

    /**
     * Get technicalSpecifications
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTechnicalSpecifications()
    {
        return $this->technicalSpecifications;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $technicalSpecifications
     * @return $this
     */
    public function setTechnicalSpecifications($technicalSpecifications)
    {
        $this->technicalSpecifications = $technicalSpecifications;

        return $this;
    }

}
