<?php
/**
 * Engine repository
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-api
 * @category repository
 * @since 2015.05.29
 */

namespace AppBundle\Repository;


use Doctrine\ORM\Mapping;

class EngineRepository extends EntityRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->addLeftJoin('f', 'fuel');
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'e';
    }

}