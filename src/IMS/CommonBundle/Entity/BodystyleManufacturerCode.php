<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BodystyleManufacturerCode
 */
class BodystyleManufacturerCode implements EntityInterface, ManufacturerCodeInterface
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
     * @var \IMS\CommonBundle\Entity\Bodystyle
     */
    private $bodystyle;

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
     * @return BodystyleManufacturerCode
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
     * Set bodystyle
     *
     * @param \IMS\CommonBundle\Entity\Bodystyle $bodystyle
     * @return BodystyleManufacturerCode
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
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return BodystyleManufacturerCode
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
