<?php
/**
 * Bodystyle Repository for bodystyle operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package app
 * @category repository
 * @since 2015.05.12
 */

namespace AppBundle\Repository;

use Doctrine\ORM\Query;

class BodystyleRepository extends EntityRepository implements EntityRepositoryInterface
{
    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'bs';
    }

}