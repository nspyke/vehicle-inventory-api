<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TransmissionManufacturerCode
 */
class TransmissionManufacturerCode implements EntityInterface, ManufacturerCodeInterface
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
     * @var \IMS\CommonBundle\Entity\Transmission
     */
    private $transmission;

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
     * @return TransmissionManufacturerCode
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
     * Set transmission
     *
     * @param \IMS\CommonBundle\Entity\Transmission $transmission
     * @return TransmissionManufacturerCode
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
     * Set manufacturer
     *
     * @param \IMS\CommonBundle\Entity\Manufacturer $manufacturer
     * @return TransmissionManufacturerCode
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
