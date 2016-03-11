<?php
/**
 * Interface to identify entities
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-common
 * @category entity
 * @since 2015.05.13
 */

namespace IMS\CommonBundle\Entity;


interface EntityInterface 
{
    /**
     * @return integer
     */
    public function getId();

}