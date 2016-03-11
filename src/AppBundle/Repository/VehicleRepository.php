<?php
namespace AppBundle\Repository;

use Doctrine\ORM\Query;

class VehicleRepository extends EntityRepository implements EntityRepositoryInterface
{

    /**
     * @param string $alias
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder($alias)
    {
        return $this->createQueryBuilder($alias)
            ->addSelect('manufacturer')
            ->leftJoin("$alias.manufacturer", 'manufacturer')

            ->addSelect('t')
            ->leftJoin("$alias.transmission", 't')

            ->addSelect('wb')
            ->leftJoin("$alias.wheelbase", 'wb')

            ->addSelect('ts')
            ->leftJoin("$alias.trimShade", 'ts')

            ->addSelect('bs')
            ->leftJoin("$alias.bodystyle", 'bs')

            ->addSelect('ce')
            ->leftJoin("$alias.colourExterior", 'ce')

            ->addSelect('model')
            ->leftJoin("$alias.model", 'model')

            ->addSelect('e')
            ->leftJoin("$alias.engine", 'e')

            ->addSelect('tm')
            ->leftJoin("$alias.trimMaterial", 'tm')

            ->addSelect('var')
            ->leftJoin("$alias.variant", 'var')

            ->addSelect('trim')
            ->leftJoin("$alias.trim", 'trim')

            ->addSelect('vp')
            ->leftJoin("$alias.vehiclePrices", 'vp')
            ->addSelect('vpc')
            ->leftJoin("vp.currency", 'vpc')

            ->addSelect('eq')
            ->leftJoin("$alias.equipment", 'eq')
            ->addSelect('eqt')
            ->leftJoin("eq.equipmentType", 'eqt')

            ->addSelect('p')
            ->leftJoin("$alias.package", 'p')
            ->addSelect('pt')
            ->leftJoin("p.packageType", 'pt')

            ->addSelect('tsd')
            ->leftJoin("$alias.technicalSpecificationData", 'tsd')
            ;
    }

    /**
     * @return string
     */
    protected function getAlias()
    {
        return 'v';
    }
}