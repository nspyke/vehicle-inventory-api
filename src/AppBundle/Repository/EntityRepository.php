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

use Doctrine\ORM\QueryBuilder;
use Gedmo\Translatable\TranslatableListener;
use Doctrine\ORM\Query;

abstract class EntityRepository extends \Doctrine\ORM\EntityRepository implements EntityRepositoryInterface
{
    private $leftJoins = [];

    /**
     * @param $value
     * @param string $field
     * @param bool $partialLoad
     * @return \Doctrine\ORM\Query
     */
    public function findByQuery($value, $field = 'id', $partialLoad = true)
    {
        $qb = $this->getQueryBuilder($this->getAlias())
            ->where($this->getAlias().".$field = ?1")
            ->setParameter(1, $value);

        $query = $this->getQuery($qb, $partialLoad);

        return $query;
    }

    /**
     * @param string $alias
     * @return QueryBuilder
     */
    public function getQueryBuilder($alias)
    {
        $qb = $this->createQueryBuilder($alias);

        foreach ($this->leftJoins as $joinAlias => $join) {
            $qb ->addSelect($joinAlias)
                ->leftJoin("$alias.$join", $joinAlias);
        }

        return $qb;
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param bool $partialLoad
     * @param bool $translationWalker
     * @param string $locale
     * @return Query
     */
    public function getQuery(QueryBuilder $queryBuilder, $partialLoad = true, $translationWalker = true, $locale = null)
    {
        $query = $queryBuilder->getQuery();

        if ($partialLoad) {
            $query = $this->setPartialLoad($query);
        }

        if ($translationWalker) {
            $query = $this->setTranslationWalker($query);
        }

        if (!is_null($locale)) {
            $query = $this->setTranslatableLocale($query, $locale);
        }

        return $query;
    }

    /**
     * @param Query $query
     * @return Query
     */
    public function setPartialLoad(Query $query)
    {
        $query->setHint(
            Query::HINT_FORCE_PARTIAL_LOAD,
            true
        );

        return $query;
    }

    /**
     * @param Query $query
     * @return Query
     */
    public function setTranslationWalker(Query $query)
    {
        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query;
    }

    /**
     * @param Query $query
     * @param string $locale
     * @return Query
     */
    public function setTranslatableLocale(Query $query, $locale)
    {
        $query->setHint(
            TranslatableListener::HINT_TRANSLATABLE_LOCALE,
            $locale
        );

        return $query;
    }

    protected function addLeftJoin($alias, $associationName)
    {
        $this->leftJoins[$alias] = $associationName;

        return $this;
    }

    /**
     * @return string
     */
    abstract protected function getAlias();
}