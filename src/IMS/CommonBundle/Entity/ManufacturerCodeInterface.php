<?php
/**
 * Interface to tag Manufacturer Code entities
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-common
 * @category entity
 * @since 2015.06.01
 */

namespace IMS\CommonBundle\Entity;


interface ManufacturerCodeInterface 
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     * @return self
     */
    public function setCode($code);
}