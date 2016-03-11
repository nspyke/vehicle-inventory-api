<?php

namespace IMS\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Translatable\Translatable;

/**
 * Fuel
 */
class Fuel implements EntityInterface, Translatable
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
    private $engines;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->engines = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Fuel
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
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Fuel
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
     * @return Fuel
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
     * @return Fuel
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
     * Add engines
     *
     * @param \IMS\CommonBundle\Entity\Engine $engines
     * @return Fuel
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
     * @param \Doctrine\Common\Collections\Collection $engines
     * @return $this
     */
    public function setEngines($engines)
    {
        $this->engines = $engines;

        return $this;
    }
}
