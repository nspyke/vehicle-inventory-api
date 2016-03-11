<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColourManufacturerCode
 */
class ColourManufacturerCode implements EntityInterface, ManufacturerCodeInterface
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
     * @var \IMS\CommonBundle\Entity\Colour
     */
    private $colour;

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
     * @return ColourManufacturerCode
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
     * Set colour
     *
     * @param \IMS\CommonBundle\Entity\Colour $colour
     * @return ColourManufacturerCode
     */
    public function setColour(\IMS\CommonBundle\Entity\Colour $colour = null)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return \IMS\CommonBundle\Entity\Colour 
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return ColourManufacturerCode
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
