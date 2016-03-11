<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.20
 */

namespace ApiBundle\Tests;


use IMS\CommonBundle\Entity\EntityInterface;

class TestEntity implements EntityInterface
{
    private $id;

    private $name;

    private $dateUpdated;

    function __construct($id, $name, $dateUpdated)
    {
        $this->id = $id;
        $this->name = $name;
        $this->dateUpdated = $dateUpdated;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
}