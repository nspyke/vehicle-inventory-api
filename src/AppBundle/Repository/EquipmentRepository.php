<?php
/**
 * Equipment Repository for equipment operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package app
 * @category repository
 * @since 2015.05.06
 */

namespace AppBundle\Repository;

use Doctrine\ORM\Mapping;

class EquipmentRepository extends EntityRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->addLeftJoin('et', 'equipmentType');
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'e';
    }
}