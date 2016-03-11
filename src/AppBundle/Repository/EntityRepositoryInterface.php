<?php
/**
 * Interface to define required methods in Entity Repositories
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package app
 * @category repository
 * @since 2015.05.15
 */

namespace AppBundle\Repository;


use Doctrine\ORM\QueryBuilder;

interface EntityRepositoryInterface
{
    /**
     * @param string $alias
     * @return QueryBuilder
     */
    public function getQueryBuilder($alias);
}