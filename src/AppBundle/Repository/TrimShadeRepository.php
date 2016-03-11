<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-api
 * @category 
 * @since 2015.05.29
 */

namespace AppBundle\Repository;

use Doctrine\ORM\Mapping;

class TrimShadeRepository extends EntityRepository implements EntityRepositoryInterface
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->addLeftJoin('trim', 'trim');
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'ts';
    }
}