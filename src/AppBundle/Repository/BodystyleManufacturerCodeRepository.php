<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-api
 * @category 
 * @since 2015.06.01
 */

namespace AppBundle\Repository;


use Doctrine\ORM\Mapping;

class BodystyleManufacturerCodeRepository extends EntityRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->addLeftJoin('bs', 'bodystyle');
        $this->addLeftJoin('manu', 'manufacturer');
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'bsmc';
    }

}