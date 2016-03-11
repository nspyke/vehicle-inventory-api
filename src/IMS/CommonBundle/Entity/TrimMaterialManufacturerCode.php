<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrimMaterialManufacturerCode
 */
class TrimMaterialManufacturerCode implements EntityInterface, ManufacturerCodeInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var \IMS\CommonBundle\Entity\TrimMaterial
     */
    private $trimMaterial;

    /**
     * @var \IMS\CommonBundle\Entity\Manufacturer
     */
    private $manufacturer;


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
     * Set manufacturerCode
     *
     * @param string $code
     * @return TrimMaterialManufacturerCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get manufacturerCode
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set trimMaterial
     *
     * @param \IMS\CommonBundle\Entity\TrimMaterial $trimMaterial
     * @return TrimMaterialManufacturerCode
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
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return TrimMaterialManufacturerCode
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
}
