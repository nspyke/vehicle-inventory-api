<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TrimManufacturerCode
 */
class TrimManufacturerCode implements EntityInterface, ManufacturerCodeInterface
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
     * @var \IMS\CommonBundle\Entity\Trim
     */
    private $trim;

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
     * @return TrimManufacturerCode
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
     * Set trim
     *
     * @param \IMS\CommonBundle\Entity\Trim $trim
     * @return TrimManufacturerCode
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
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return TrimManufacturerCode
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
