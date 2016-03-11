<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WheelbaseManufacturerCode
 */
class WheelbaseManufacturerCode implements EntityInterface, ManufacturerCodeInterface
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
     * @var \IMS\CommonBundle\Entity\Wheelbase
     */
    private $wheelbase;

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
     * @return WheelbaseManufacturerCode
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
     * Set wheelbase
     *
     * @param \IMS\CommonBundle\Entity\Wheelbase $wheelbase
     * @return WheelbaseManufacturerCode
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
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return WheelbaseManufacturerCode
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
