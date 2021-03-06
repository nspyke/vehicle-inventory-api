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

class TransmissionManufacturerCodeRepository extends EntityRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->addLeftJoin('t', 'transmission');
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'tmc';
    }

}