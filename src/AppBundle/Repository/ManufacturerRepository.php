<?php
/**
 * Manufacturer Repository for manufacturer operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package app
 * @category repository
 * @since 2015.05.12
 */

namespace AppBundle\Repository;

use Doctrine\ORM\Query;

class ManufacturerRepository extends EntityRepository
{
    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'man';
    }

}