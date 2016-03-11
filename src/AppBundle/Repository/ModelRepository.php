<?php
namespace AppBundle\Repository;

use Doctrine\ORM\Mapping;

class ModelRepository extends EntityRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this
            ->addLeftJoin('man', 'manufacturer')
            ->addLeftJoin('mg', 'modelGroup')
        ;
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'mdl';
    }
}