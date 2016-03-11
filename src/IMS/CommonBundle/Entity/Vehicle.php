<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 */
class Vehicle implements EntityInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $vin;

    /**
     * @var string
     */
    private $reg;

    /**
     * @var integer
     */
    private $vehicleStatus;

    /**
     * @var integer
     */
    private $vehicleType;

    /**
     * @var integer
     */
    private $doors;

    /**
     * @var integer
     */
    private $seats;

    /**
     * @var string
     */
    private $drive;

    /**
     * @var integer
     */
    private $odometer;

    /**
     * @var integer
     */
    private $odometerCanonical;

    /**
     * @var string
     */
    private $odometerUnit;

    /**
     * @var \DateTime
     */
    private $dateRegistered;

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
     * @var boolean
     */
    private $isNew;

    /**
     * @var boolean
     */
    private $isManufacturerApproved;

    /**
     * @var boolean
     */
    private $isFeatured;

    /**
     * @var boolean
     */
    private $isVisible;

    /**
     * @var integer
     */
    private $status;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $manufacturer;

    /**
     * @var \IMS\CommonBundle\Entity\Model
     */
    private $model;

    /**
     * @var \IMS\CommonBundle\Entity\Variant
     */
    private $variant;

    /**
     * @var \IMS\CommonBundle\Entity\Dealer
     */
    private $dealer;

    /**
     * @var \IMS\CommonBundle\Entity\Transmission
     */
    private $transmission;

    /**
     * @var \IMS\CommonBundle\Entity\Engine
     */
    private $engine;

    /**
     * @var \IMS\CommonBundle\Entity\Bodystyle
     */
    private $bodystyle;

    /**
     * @var \IMS\CommonBundle\Entity\Colour
     */
    private $colourExterior;

    /**
     * @var \IMS\CommonBundle\Entity\Trim
     */
    private $trim;

    /**
     * @var \IMS\CommonBundle\Entity\TrimMaterial
     */
    private $trimMaterial;

    /**
     * @var \IMS\CommonBundle\Entity\TrimShade
     */
    private $trimShade;

    /**
     * @var \IMS\CommonBundle\Entity\Wheelbase
     */
    private $wheelbase;

    /**
     * @var \IMS\CommonBundle\Entity\TechnicalSpecificationData
     */
    private $technicalSpecificationData;

    /**
     * @var \IMS\CommonBundle\Entity\Package
     */
    private $package;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $equipment;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vehiclePrices;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->vehiclePrices = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set vin
     *
     * @param string $vin
     * @return Vehicle
     */
    public function setVin($vin)
    {
        $this->vin = $vin;

        return $this;
    }

    /**
     * Get vin
     *
     * @return string 
     */
    public function getVin()
    {
        return $this->vin;
    }

    /**
     * Set reg
     *
     * @param string $reg
     * @return Vehicle
     */
    public function setReg($reg)
    {
        $this->reg = $reg;

        return $this;
    }

    /**
     * Get reg
     *
     * @return string 
     */
    public function getReg()
    {
        return $this->reg;
    }

    /**
     * Set vehicleStatus
     *
     * @param integer $vehicleStatus
     * @return Vehicle
     */
    public function setVehicleStatus($vehicleStatus)
    {
        $this->vehicleStatus = $vehicleStatus;

        return $this;
    }

    /**
     * Get vehicleStatus
     *
     * @return integer 
     */
    public function getVehicleStatus()
    {
        return $this->vehicleStatus;
    }

    /**
     * @return int
     */
    public function getVehicleType()
    {
        return $this->vehicleType;
    }

    /**
     * @param int $vehicleType
     * @return $this
     */
    public function setVehicleType($vehicleType)
    {
        $this->vehicleType = $vehicleType;

        return $this;
    }

    /**
     * Set doors
     *
     * @param integer $doors
     * @return Vehicle
     */
    public function setDoors($doors)
    {
        $this->doors = $doors;

        return $this;
    }

    /**
     * Get doors
     *
     * @return integer 
     */
    public function getDoors()
    {
        return $this->doors;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     * @return Vehicle
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return integer 
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set drive
     *
     * @param string $drive
     * @return Vehicle
     */
    public function setDrive($drive)
    {
        $this->drive = $drive;

        return $this;
    }

    /**
     * Get drive
     *
     * @return string 
     */
    public function getDrive()
    {
        return $this->drive;
    }

    /**
     * Set odometer
     *
     * @param integer $odometer
     * @return Vehicle
     */
    public function setOdometer($odometer)
    {
        $this->odometer = $odometer;

        return $this;
    }

    /**
     * Get odometer
     *
     * @return integer 
     */
    public function getOdometer()
    {
        return $this->odometer;
    }

    /**
     * Set odometerCanonical
     *
     * @param integer $odometerCanonical
     * @return Vehicle
     */
    public function setOdometerCanonical($odometerCanonical)
    {
        $this->odometerCanonical = $odometerCanonical;

        return $this;
    }

    /**
     * Get odometerCanonical
     *
     * @return integer 
     */
    public function getOdometerCanonical()
    {
        return $this->odometerCanonical;
    }

    /**
     * Set odometerUnit
     *
     * @param string $odometerUnit
     * @return Vehicle
     */
    public function setOdometerUnit($odometerUnit)
    {
        $this->odometerUnit = $odometerUnit;

        return $this;
    }

    /**
     * Get odometerUnit
     *
     * @return string 
     */
    public function getOdometerUnit()
    {
        return $this->odometerUnit;
    }

    /**
     * Set dateRegistered
     *
     * @param \DateTime $dateRegistered
     * @return Vehicle
     */
    public function setDateRegistered($dateRegistered)
    {
        $this->dateRegistered = $dateRegistered;

        return $this;
    }

    /**
     * Get dateRegistered
     *
     * @return \DateTime 
     */
    public function getDateRegistered()
    {
        return $this->dateRegistered;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Vehicle
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
     * @return Vehicle
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
     * @return Vehicle
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
     * @return Vehicle
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
     * Set isNew
     *
     * @param boolean $isNew
     * @return Vehicle
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;

        return $this;
    }

    /**
     * Get isNew
     *
     * @return boolean 
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    /**
     * Set isManufacturerApproved
     *
     * @param boolean $isManufacturerApproved
     * @return Vehicle
     */
    public function setIsManufacturerApproved($isManufacturerApproved)
    {
        $this->isManufacturerApproved = $isManufacturerApproved;

        return $this;
    }

    /**
     * Get isManufacturerApproved
     *
     * @return boolean 
     */
    public function getIsManufacturerApproved()
    {
        return $this->isManufacturerApproved;
    }

    /**
     * Set isFeatured
     *
     * @param boolean $isFeatured
     * @return Vehicle
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    /**
     * Get isFeatured
     *
     * @return boolean 
     */
    public function getIsFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * Set isVisible
     *
     * @param boolean $isVisible
     * @return Vehicle
     */
    public function setIsVisible($isVisible)
    {
        $this->isVisible = $isVisible;

        return $this;
    }

    /**
     * Get isVisible
     *
     * @return boolean 
     */
    public function getIsVisible()
    {
        return $this->isVisible;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Vehicle
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
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return Vehicle
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
     * @param \IMS\CommonBundle\Entity\Model $model
     * @return Vehicle
     */
    public function setModel(\IMS\CommonBundle\Entity\Model $model = null)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get model
     *
     * @return \IMS\CommonBundle\Entity\Model 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set variant
     *
     * @param \IMS\CommonBundle\Entity\Variant $variant
     * @return Vehicle
     */
    public function setVariant(\IMS\CommonBundle\Entity\Variant $variant = null)
    {
        $this->variant = $variant;

        return $this;
    }

    /**
     * Get variant
     *
     * @return \IMS\CommonBundle\Entity\Variant 
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * Set dealer
     *
     * @param \IMS\CommonBundle\Entity\Dealer $dealer
     * @return Vehicle
     */
    public function setDealer(\IMS\CommonBundle\Entity\Dealer $dealer = null)
    {
        $this->dealer = $dealer;

        return $this;
    }

    /**
     * Get dealer
     *
     * @return \IMS\CommonBundle\Entity\Dealer 
     */
    public function getDealer()
    {
        return $this->dealer;
    }

    /**
     * Set transmission
     *
     * @param \IMS\CommonBundle\Entity\Transmission $transmission
     * @return Vehicle
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

    /**
     * Set engine
     *
     * @param \IMS\CommonBundle\Entity\Engine $engine
     * @return Vehicle
     */
    public function setEngine(\IMS\CommonBundle\Entity\Engine $engine = null)
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * Get engine
     *
     * @return \IMS\CommonBundle\Entity\Engine 
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Set bodystyle
     *
     * @param \IMS\CommonBundle\Entity\Bodystyle $bodystyle
     * @return Vehicle
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
     * Set colourExterior
     *
     * @param \IMS\CommonBundle\Entity\Colour $colourExterior
     * @return Vehicle
     */
    public function setColourExterior(\IMS\CommonBundle\Entity\Colour $colourExterior = null)
    {
        $this->colourExterior = $colourExterior;

        return $this;
    }

    /**
     * Get colourExterior
     *
     * @return \IMS\CommonBundle\Entity\Colour 
     */
    public function getColourExterior()
    {
        return $this->colourExterior;
    }

    /**
     * Set trim
     *
     * @param \IMS\CommonBundle\Entity\Trim $trim
     * @return Vehicle
     */
    public function setTrim(\IMS\CommonBundle\Entity\Trim $trim = null)
    {
        $this->trim = $trim;

        return $this;
    }

    /**
     * Get trim
     *
     * @return \IMS\CommonBundle\Entity\Trim 
     */
    public function getTrim()
    {
        return $this->trim;
    }

    /**
     * Set trimMaterial
     *
     * @param \IMS\CommonBundle\Entity\TrimMaterial $trimMaterial
     * @return Vehicle
     */
    public function setTrimMaterial(\IMS\CommonBundle\Entity\TrimMaterial $trimMaterial = null)
    {
        $this->trimMaterial = $trimMaterial;

        return $this;
    }

    /**
     * Get trimMaterial
     *
     * @return \IMS\CommonBundle\Entity\TrimMaterial 
     */
    public function getTrimMaterial()
    {
        return $this->trimMaterial;
    }

    /**
     * Set trimShade
     *
     * @param \IMS\CommonBundle\Entity\TrimShade $trimShade
     * @return Vehicle
     */
    public function setTrimShade(\IMS\CommonBundle\Entity\TrimShade $trimShade = null)
    {
        $this->trimShade = $trimShade;

        return $this;
    }

    /**
     * Get trimShade
     *
     * @return \IMS\CommonBundle\Entity\TrimShade 
     */
    public function getTrimShade()
    {
        return $this->trimShade;
    }

    /**
     * Set wheelbase
     *
     * @param \IMS\CommonBundle\Entity\Wheelbase $wheelbase
     * @return Vehicle
     */
    public function setWheelbase(\IMS\CommonBundle\Entity\Wheelbase $wheelbase = null)
    {
        $this->wheelbase = $wheelbase;

        return $this;
    }

    /**
     * Get wheelbase
     *
     * @return \IMS\CommonBundle\Entity\Wheelbase 
     */
    public function getWheelbase()
    {
        return $this->wheelbase;
    }

    /**
     * Set technicalSpecificationData
     *
     * @param \IMS\CommonBundle\Entity\TechnicalSpecificationData $technicalSpecificationData
     * @return Vehicle
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
     * Set package
     *
     * @param \IMS\CommonBundle\Entity\Package $package
     * @return Vehicle
     */
    public function setPackage(\IMS\CommonBundle\Entity\Package $package = null)
    {
        $this->package = $package;

        return $this;
    }

    /**
     * Get package
     *
     * @return \IMS\CommonBundle\Entity\Package 
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * Add equipment
     *
     * @param \IMS\CommonBundle\Entity\Equipment $equipment
     * @return Vehicle
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
     * @param \Doctrine\Common\Collections\Collection $equipment
     * @return $this
     */
    public function setEquipment($equipment)
    {
        $this->equipment = $equipment;

        return $this;
    }

    /**
     * Add VehiclePrice
     *
     * @param VehiclePrice $vehiclePrice
     * @return Vehicle
     */
    public function addVehiclePrice(VehiclePrice $vehiclePrice)
    {
        $this->vehiclePrices[] = $vehiclePrice;

        return $this;
    }

    /**
     * Remove VehiclePrice
     *
     * @param VehiclePrice $vehiclePrice
     */
    public function removeVehiclePrice(VehiclePrice $vehiclePrice)
    {
        $this->vehiclePrices->removeElement($vehiclePrice);
    }

    /**
     * Get vehiclePrices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehiclePrices()
    {
        return $this->vehiclePrices;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $vehiclePrices
     * @return $this
     */
    public function setVehiclePrices($vehiclePrices)
    {
        $this->vehiclePrices = $vehiclePrices;

        return $this;
    }

}
