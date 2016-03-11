<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * Manufacturer
 */
class Manufacturer implements EntityInterface, Translatable
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
     * @var integer
     */
    private $status;

    /**
     * @var string
     */
    private $code;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $vehicles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bodystyleManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $colourManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $engineManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $equipmentManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $equipmentTypes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $modelGroups;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $transmissionManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $trimManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $trimMaterialManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $wheelbaseManufacturerCodes;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $bodystyles;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $colours;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $dealers;

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
    private $models;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $transmissions;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $trims;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $trimMaterials;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $variants;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $wheelbases;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vehicles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bodystyleManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colourManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->engineManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipmentManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipmentTypes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modelGroups = new \Doctrine\Common\Collections\ArrayCollection();
        $this->transmissionManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trimManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trimMaterialManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->wheelbaseManufacturerCodes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->bodystyles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->colours = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dealers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->engines = new \Doctrine\Common\Collections\ArrayCollection();
        $this->equipment = new \Doctrine\Common\Collections\ArrayCollection();
        $this->models = new \Doctrine\Common\Collections\ArrayCollection();
        $this->transmissions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trims = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trimMaterials = new \Doctrine\Common\Collections\ArrayCollection();
        $this->variants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->wheelbases = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Manufacturer
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
     * Set isVerified
     *
     * @param boolean $isVerified
     * @return Manufacturer
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
     * @return Manufacturer
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
     * @return Manufacturer
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
     * @return Manufacturer
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
     * Set code
     *
     * @param string $code
     * @return Manufacturer
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add vehicles
     *
     * @param \IMS\CommonBundle\Entity\Vehicle $vehicles
     * @return Manufacturer
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
     * Add bodystyleManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\BodystyleManufacturerCode $bodystyleManufacturerCodes
     * @return Manufacturer
     */
    public function addBodystyleManufacturerCode(\IMS\CommonBundle\Entity\BodystyleManufacturerCode $bodystyleManufacturerCodes)
    {
        $this->bodystyleManufacturerCodes[] = $bodystyleManufacturerCodes;

        return $this;
    }

    /**
     * Remove bodystyleManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\BodystyleManufacturerCode $bodystyleManufacturerCodes
     */
    public function removeBodystyleManufacturerCode(\IMS\CommonBundle\Entity\BodystyleManufacturerCode $bodystyleManufacturerCodes)
    {
        $this->bodystyleManufacturerCodes->removeElement($bodystyleManufacturerCodes);
    }

    /**
     * Get bodystyleManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBodystyleManufacturerCodes()
    {
        return $this->bodystyleManufacturerCodes;
    }

    /**
     * Add colourManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\ColourManufacturerCode $colourManufacturerCodes
     * @return Manufacturer
     */
    public function addColourManufacturerCode(\IMS\CommonBundle\Entity\ColourManufacturerCode $colourManufacturerCodes)
    {
        $this->colourManufacturerCodes[] = $colourManufacturerCodes;

        return $this;
    }

    /**
     * Remove colourManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\ColourManufacturerCode $colourManufacturerCodes
     */
    public function removeColourManufacturerCode(\IMS\CommonBundle\Entity\ColourManufacturerCode $colourManufacturerCodes)
    {
        $this->colourManufacturerCodes->removeElement($colourManufacturerCodes);
    }

    /**
     * Get colourManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColourManufacturerCodes()
    {
        return $this->colourManufacturerCodes;
    }

    /**
     * Add engineManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\EngineManufacturerCode $engineManufacturerCodes
     * @return Manufacturer
     */
    public function addEngineManufacturerCode(\IMS\CommonBundle\Entity\EngineManufacturerCode $engineManufacturerCodes)
    {
        $this->engineManufacturerCodes[] = $engineManufacturerCodes;

        return $this;
    }

    /**
     * Remove engineManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\EngineManufacturerCode $engineManufacturerCodes
     */
    public function removeEngineManufacturerCode(\IMS\CommonBundle\Entity\EngineManufacturerCode $engineManufacturerCodes)
    {
        $this->engineManufacturerCodes->removeElement($engineManufacturerCodes);
    }

    /**
     * Get engineManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEngineManufacturerCodes()
    {
        return $this->engineManufacturerCodes;
    }

    /**
     * Add equipmentManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\EquipmentManufacturerCode $equipmentManufacturerCodes
     * @return Manufacturer
     */
    public function addEquipmentManufacturerCode(\IMS\CommonBundle\Entity\EquipmentManufacturerCode $equipmentManufacturerCodes)
    {
        $this->equipmentManufacturerCodes[] = $equipmentManufacturerCodes;

        return $this;
    }

    /**
     * Remove equipmentManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\EquipmentManufacturerCode $equipmentManufacturerCodes
     */
    public function removeEquipmentManufacturerCode(\IMS\CommonBundle\Entity\EquipmentManufacturerCode $equipmentManufacturerCodes)
    {
        $this->equipmentManufacturerCodes->removeElement($equipmentManufacturerCodes);
    }

    /**
     * Get equipmentManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipmentManufacturerCodes()
    {
        return $this->equipmentManufacturerCodes;
    }

    /**
     * Add equipmentTypes
     *
     * @param \IMS\CommonBundle\Entity\EquipmentType $equipmentTypes
     * @return Manufacturer
     */
    public function addEquipmentType(\IMS\CommonBundle\Entity\EquipmentType $equipmentTypes)
    {
        $this->equipmentTypes[] = $equipmentTypes;

        return $this;
    }

    /**
     * Remove equipmentTypes
     *
     * @param \IMS\CommonBundle\Entity\EquipmentType $equipmentTypes
     */
    public function removeEquipmentType(\IMS\CommonBundle\Entity\EquipmentType $equipmentTypes)
    {
        $this->equipmentTypes->removeElement($equipmentTypes);
    }

    /**
     * Get equipmentTypes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipmentTypes()
    {
        return $this->equipmentTypes;
    }

    /**
     * Add modelGroups
     *
     * @param \IMS\CommonBundle\Entity\ModelGroup $modelGroups
     * @return Manufacturer
     */
    public function addModelGroup(\IMS\CommonBundle\Entity\ModelGroup $modelGroups)
    {
        $this->modelGroups[] = $modelGroups;

        return $this;
    }

    /**
     * Remove modelGroups
     *
     * @param \IMS\CommonBundle\Entity\ModelGroup $modelGroups
     */
    public function removeModelGroup(\IMS\CommonBundle\Entity\ModelGroup $modelGroups)
    {
        $this->modelGroups->removeElement($modelGroups);
    }

    /**
     * Get modelGroups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModelGroups()
    {
        return $this->modelGroups;
    }

    /**
     * Add transmissionManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\TransmissionManufacturerCode $transmissionManufacturerCodes
     * @return Manufacturer
     */
    public function addTransmissionManufacturerCode(\IMS\CommonBundle\Entity\TransmissionManufacturerCode $transmissionManufacturerCodes)
    {
        $this->transmissionManufacturerCodes[] = $transmissionManufacturerCodes;

        return $this;
    }

    /**
     * Remove transmissionManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\TransmissionManufacturerCode $transmissionManufacturerCodes
     */
    public function removeTransmissionManufacturerCode(\IMS\CommonBundle\Entity\TransmissionManufacturerCode $transmissionManufacturerCodes)
    {
        $this->transmissionManufacturerCodes->removeElement($transmissionManufacturerCodes);
    }

    /**
     * Get transmissionManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransmissionManufacturerCodes()
    {
        return $this->transmissionManufacturerCodes;
    }

    /**
     * Add trimManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\TrimManufacturerCode $trimManufacturerCodes
     * @return Manufacturer
     */
    public function addTrimManufacturerCode(\IMS\CommonBundle\Entity\TrimManufacturerCode $trimManufacturerCodes)
    {
        $this->trimManufacturerCodes[] = $trimManufacturerCodes;

        return $this;
    }

    /**
     * Remove trimManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\TrimManufacturerCode $trimManufacturerCodes
     */
    public function removeTrimManufacturerCode(\IMS\CommonBundle\Entity\TrimManufacturerCode $trimManufacturerCodes)
    {
        $this->trimManufacturerCodes->removeElement($trimManufacturerCodes);
    }

    /**
     * Get trimManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrimManufacturerCodes()
    {
        return $this->trimManufacturerCodes;
    }

    /**
     * Add trimMaterialManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $trimMaterialManufacturerCodes
     * @return Manufacturer
     */
    public function addTrimMaterialManufacturerCode(\IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $trimMaterialManufacturerCodes)
    {
        $this->trimMaterialManufacturerCodes[] = $trimMaterialManufacturerCodes;

        return $this;
    }

    /**
     * Remove trimMaterialManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $trimMaterialManufacturerCodes
     */
    public function removeTrimMaterialManufacturerCode(\IMS\CommonBundle\Entity\TrimMaterialManufacturerCode $trimMaterialManufacturerCodes)
    {
        $this->trimMaterialManufacturerCodes->removeElement($trimMaterialManufacturerCodes);
    }

    /**
     * Get trimMaterialManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrimMaterialManufacturerCodes()
    {
        return $this->trimMaterialManufacturerCodes;
    }

    /**
     * Add wheelbaseManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\WheelbaseManufacturerCode $wheelbaseManufacturerCodes
     * @return Manufacturer
     */
    public function addWheelbaseManufacturerCode(\IMS\CommonBundle\Entity\WheelbaseManufacturerCode $wheelbaseManufacturerCodes)
    {
        $this->wheelbaseManufacturerCodes[] = $wheelbaseManufacturerCodes;

        return $this;
    }

    /**
     * Remove wheelbaseManufacturerCodes
     *
     * @param \IMS\CommonBundle\Entity\WheelbaseManufacturerCode $wheelbaseManufacturerCodes
     */
    public function removeWheelbaseManufacturerCode(\IMS\CommonBundle\Entity\WheelbaseManufacturerCode $wheelbaseManufacturerCodes)
    {
        $this->wheelbaseManufacturerCodes->removeElement($wheelbaseManufacturerCodes);
    }

    /**
     * Get wheelbaseManufacturerCodes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWheelbaseManufacturerCodes()
    {
        return $this->wheelbaseManufacturerCodes;
    }

    /**
     * Add bodystyles
     *
     * @param \IMS\CommonBundle\Entity\Bodystyle $bodystyles
     * @return Manufacturer
     */
    public function addBodystyle(\IMS\CommonBundle\Entity\Bodystyle $bodystyles)
    {
        $this->bodystyles[] = $bodystyles;

        return $this;
    }

    /**
     * Remove bodystyles
     *
     * @param \IMS\CommonBundle\Entity\Bodystyle $bodystyles
     */
    public function removeBodystyle(\IMS\CommonBundle\Entity\Bodystyle $bodystyles)
    {
        $this->bodystyles->removeElement($bodystyles);
    }

    /**
     * Get bodystyles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBodystyles()
    {
        return $this->bodystyles;
    }

    /**
     * Add colours
     *
     * @param \IMS\CommonBundle\Entity\Colour $colours
     * @return Manufacturer
     */
    public function addColour(\IMS\CommonBundle\Entity\Colour $colours)
    {
        $this->colours[] = $colours;

        return $this;
    }

    /**
     * Remove colours
     *
     * @param \IMS\CommonBundle\Entity\Colour $colours
     */
    public function removeColour(\IMS\CommonBundle\Entity\Colour $colours)
    {
        $this->colours->removeElement($colours);
    }

    /**
     * Get colours
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getColours()
    {
        return $this->colours;
    }

    /**
     * Add dealers
     *
     * @param \IMS\CommonBundle\Entity\Dealer $dealers
     * @return Manufacturer
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
     * Add engines
     *
     * @param \IMS\CommonBundle\Entity\Engine $engines
     * @return Manufacturer
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
     * @return Manufacturer
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
     * Add models
     *
     * @param \IMS\CommonBundle\Entity\Model $models
     * @return Manufacturer
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
     * Add transmissions
     *
     * @param \IMS\CommonBundle\Entity\Transmission $transmissions
     * @return Manufacturer
     */
    public function addTransmission(\IMS\CommonBundle\Entity\Transmission $transmissions)
    {
        $this->transmissions[] = $transmissions;

        return $this;
    }

    /**
     * Remove transmissions
     *
     * @param \IMS\CommonBundle\Entity\Transmission $transmissions
     */
    public function removeTransmission(\IMS\CommonBundle\Entity\Transmission $transmissions)
    {
        $this->transmissions->removeElement($transmissions);
    }

    /**
     * Get transmissions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransmissions()
    {
        return $this->transmissions;
    }

    /**
     * Add trims
     *
     * @param \IMS\CommonBundle\Entity\Trim $trims
     * @return Manufacturer
     */
    public function addTrim(\IMS\CommonBundle\Entity\Trim $trims)
    {
        $this->trims[] = $trims;

        return $this;
    }

    /**
     * Remove trims
     *
     * @param \IMS\CommonBundle\Entity\Trim $trims
     */
    public function removeTrim(\IMS\CommonBundle\Entity\Trim $trims)
    {
        $this->trims->removeElement($trims);
    }

    /**
     * Get trims
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrims()
    {
        return $this->trims;
    }

    /**
     * Add trimMaterials
     *
     * @param \IMS\CommonBundle\Entity\TrimMaterial $trimMaterials
     * @return Manufacturer
     */
    public function addTrimMaterial(\IMS\CommonBundle\Entity\TrimMaterial $trimMaterials)
    {
        $this->trimMaterials[] = $trimMaterials;

        return $this;
    }

    /**
     * Remove trimMaterials
     *
     * @param \IMS\CommonBundle\Entity\TrimMaterial $trimMaterials
     */
    public function removeTrimMaterial(\IMS\CommonBundle\Entity\TrimMaterial $trimMaterials)
    {
        $this->trimMaterials->removeElement($trimMaterials);
    }

    /**
     * Get trimMaterials
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrimMaterials()
    {
        return $this->trimMaterials;
    }

    /**
     * Add variants
     *
     * @param \IMS\CommonBundle\Entity\Variant $variants
     * @return Manufacturer
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
     * Add wheelbases
     *
     * @param \IMS\CommonBundle\Entity\Wheelbase $wheelbases
     * @return Manufacturer
     */
    public function addWheelbase(\IMS\CommonBundle\Entity\Wheelbase $wheelbases)
    {
        $this->wheelbases[] = $wheelbases;

        return $this;
    }

    /**
     * Remove wheelbases
     *
     * @param \IMS\CommonBundle\Entity\Wheelbase $wheelbases
     */
    public function removeWheelbase(\IMS\CommonBundle\Entity\Wheelbase $wheelbases)
    {
        $this->wheelbases->removeElement($wheelbases);
    }

    /**
     * Get wheelbases
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWheelbases()
    {
        return $this->wheelbases;
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
     * @param \Doctrine\Common\Collections\Collection $bodystyleManufacturerCodes
     * @return $this
     */
    public function setBodystyleManufacturerCodes($bodystyleManufacturerCodes)
    {
        $this->bodystyleManufacturerCodes = $bodystyleManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $colourManufacturerCodes
     * @return $this
     */
    public function setColourManufacturerCodes($colourManufacturerCodes)
    {
        $this->colourManufacturerCodes = $colourManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $engineManufacturerCodes
     * @return $this
     */
    public function setEngineManufacturerCodes($engineManufacturerCodes)
    {
        $this->engineManufacturerCodes = $engineManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $equipmentManufacturerCodes
     * @return $this
     */
    public function setEquipmentManufacturerCodes($equipmentManufacturerCodes)
    {
        $this->equipmentManufacturerCodes = $equipmentManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $equipmentTypes
     * @return $this
     */
    public function setEquipmentTypes($equipmentTypes)
    {
        $this->equipmentTypes = $equipmentTypes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $modelGroups
     * @return $this
     */
    public function setModelGroups($modelGroups)
    {
        $this->modelGroups = $modelGroups;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $transmissionManufacturerCodes
     * @return $this
     */
    public function setTransmissionManufacturerCodes($transmissionManufacturerCodes)
    {
        $this->transmissionManufacturerCodes = $transmissionManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $trimManufacturerCodes
     * @return $this
     */
    public function setTrimManufacturerCodes($trimManufacturerCodes)
    {
        $this->trimManufacturerCodes = $trimManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $trimMaterialManufacturerCodes
     * @return $this
     */
    public function setTrimMaterialManufacturerCodes($trimMaterialManufacturerCodes)
    {
        $this->trimMaterialManufacturerCodes = $trimMaterialManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $wheelbaseManufacturerCodes
     * @return $this
     */
    public function setWheelbaseManufacturerCodes($wheelbaseManufacturerCodes)
    {
        $this->wheelbaseManufacturerCodes = $wheelbaseManufacturerCodes;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $bodystyles
     * @return $this
     */
    public function setBodystyles($bodystyles)
    {
        $this->bodystyles = $bodystyles;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $colours
     * @return $this
     */
    public function setColours($colours)
    {
        $this->colours = $colours;

        return $this;
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
     * @param \Doctrine\Common\Collections\Collection $models
     * @return $this
     */
    public function setModels($models)
    {
        $this->models = $models;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $transmissions
     * @return $this
     */
    public function setTransmissions($transmissions)
    {
        $this->transmissions = $transmissions;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $trims
     * @return $this
     */
    public function setTrims($trims)
    {
        $this->trims = $trims;

        return $this;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $trimMaterials
     * @return $this
     */
    public function setTrimMaterials($trimMaterials)
    {
        $this->trimMaterials = $trimMaterials;

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

    /**
     * @param \Doctrine\Common\Collections\Collection $wheelbases
     * @return $this
     */
    public function setWheelbases($wheelbases)
    {
        $this->wheelbases = $wheelbases;

        return $this;
    }

}
