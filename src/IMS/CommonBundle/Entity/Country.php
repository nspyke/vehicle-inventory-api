<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * Country
 */
class Country implements EntityInterface, Translatable
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
     * @var string
     */
    private $isoCode;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $currencies;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->currencies = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Country
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
     * @return string
     */
    public function getIsoCode()
    {
        return $this->isoCode;
    }

    /**
     * @param string $isoCode
     * @return $this
     */
    public function setIsoCode($isoCode)
    {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Country
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
     * @return Country
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
     * @return Country
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
     * Add currencies
     *
     * @param \IMS\CommonBundle\Entity\Currency $currencies
     * @return Country
     */
    public function addCurrency(\IMS\CommonBundle\Entity\Currency $currencies)
    {
        $this->currencies[] = $currencies;

        return $this;
    }

    /**
     * Remove currencies
     *
     * @param \IMS\CommonBundle\Entity\Currency $currencies
     */
    public function removeCurrency(\IMS\CommonBundle\Entity\Currency $currencies)
    {
        $this->currencies->removeElement($currencies);
    }

    /**
     * Get currencies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCurrencies()
    {
        return $this->currencies;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $currencies
     * @return $this
     */
    public function setCurrencies($currencies)
    {
        $this->currencies = $currencies;

        return $this;
    }

}
