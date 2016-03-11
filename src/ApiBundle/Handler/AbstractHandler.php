<?php

namespace ApiBundle\Handler;

use ApiBundle\Request\Query as RequestQuery;
use AppBundle\Exception\InvalidFormException;
use AppBundle\Repository\EntityRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\QueryBuilder;
use FOS\RestBundle\Util\Codes;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAwareInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpKernel\Exception\HttpException;

abstract class AbstractHandler implements PaginatorAwareInterface
{
    protected $entityClassName;

    /**
     * @var EntityManager
     */
    protected $objectManager;

    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    /**
     * @var \Symfony\Component\Form\FormFactory
     */
    protected $formFactory;

    /**
     * @var bool
     */
    protected $queryPartialLoad;

    /**
     * @var Paginator
     */
    protected $paginator;

    /**
     * @param ObjectManager $objectManager
     * @param string $entityClassName
     * @param bool $queryPartialLoad
     */
    public function __construct(ObjectManager $objectManager, $entityClassName, $queryPartialLoad = false)
    {
        $this->entityClassName = $entityClassName;

        if (!class_exists($entityClassName)) {
            throw new \RuntimeException("The class '$entityClassName' does not exist'");
        }

        $this->objectManager = $objectManager;        
        $this->repository = $this->objectManager->getRepository($entityClassName);
        $this->queryPartialLoad = $queryPartialLoad;
    }

    /**
     * Sets the KnpPaginator instance.
     *
     * @param Paginator $paginator
     *
     * @return PaginatorAware
     */
    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;

        return $this;
    }

    /**
     * Returns the KnpPaginator instance.
     *
     * @return Paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @param FormFactoryInterface $formFactory
     * @return $this
     */
    public function setFormFactory(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;

        return $this;
    }

    /**
     * @param $entity
     * @param FormTypeInterface $type
     * @param Request $request
     * @param $method
     * @throws InvalidFormException
     * @return mixed
     */
    protected function processForm($entity, FormTypeInterface $type, Request $request, $method)
    {
        $form = $this->formFactory->create($type, $entity, ['method' => $method]);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->objectManager->persist($entity);
            $this->objectManager->flush();
            
            return $entity;
        }
                
        throw new InvalidFormException('Invalid submission', $form);
    }

    /**
     * @param QueryBuilder $ormQueryBuilder
     * @param RequestQuery $requestQuery
     * @return \Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination
     */
    protected function handleList(QueryBuilder $ormQueryBuilder, RequestQuery $requestQuery)
    {
        $aliases = $ormQueryBuilder->getRootAliases();
        $alias = $aliases[0];

        $requestQuery->parse();

        if ($requestQuery->hasSort() or $requestQuery->hasFilters()) {

            $meta = $this->objectManager->getClassMetadata($this->entityClassName);
            $fieldNames = $meta->getFieldNames();
            $associationNames = $meta->getAssociationNames();
            $entityFields = array_merge($fieldNames, $associationNames);

            // Add the sorting
            if ($requestQuery->hasSort()) {
                foreach ($requestQuery->sort->getValue() as $sortColumn => $sortDirection) {
                    if (!in_array($sortColumn, $entityFields)) {
                        throw new HttpException(
                            Codes::HTTP_BAD_REQUEST,
                            sprintf('The sorting field "%s" does not exist in "%s"', $sortColumn, $this->entityClassName)
                        );
                    }

                    $ormQueryBuilder->addOrderBy($alias . '.' . $sortColumn, $sortDirection);
                }
            }

            // Add the filters
            if ($requestQuery->hasFilters()) {
                /** @var RequestQuery\Filter $filter */
                foreach ($requestQuery->filters as $filter) {
                    // Check if the filter key exists on the entity
                    // Throw an exception if it doesn't
                    if (!in_array($filter->getQueryKey(), $entityFields)) {
                        throw new HttpException(
                            Codes::HTTP_BAD_REQUEST,
                            sprintf('The filter field "%s" does not exist in "%s"', $filter->getQueryKey(), $this->entityClassName)
                        );
                    }

                    $expr = null;
                    $value = $filter->getValue();

                    if ($meta->isCollectionValuedAssociation($filter->getQueryKey())) {
                        if (!is_array($value)) {
                            $value = [$value];
                        }

                        foreach ($value as $v) {
                            if (!is_numeric($v)) {
                                throw new HttpException(
                                    Codes::HTTP_BAD_REQUEST,
                                    sprintf(
                                        'The filter field "%s" in "%s" only accepts primary key values for collection based associations.',
                                        $filter->getQueryKey(),
                                        $this->entityClassName
                                    )
                                );
                            }
                        }

                        $ormQueryBuilder
                            ->leftJoin($alias . '.' . $filter->getQueryKey(), $filter->getQueryKey());

                        $expr = $ormQueryBuilder->expr()->in(
                            $filter->getQueryKey().'.id', ':' . $filter->getQueryKey()
                        );

                    } else {
                        if (is_array($value)) {
                            $exprMethod = 'in';
                        } else {
                            $exprMethod = 'eq';
                        }

                        $expr = $ormQueryBuilder->expr()->$exprMethod(
                            $alias . '.' . $filter->getQueryKey(), ':' . $filter->getQueryKey()
                        );
                    }

                    $ormQueryBuilder->andWhere($expr);
                    $ormQueryBuilder->setParameter(':' . $filter->getQueryKey(), $filter->getValue());
                }
            }
        }

        $query = $this->repository instanceof EntityRepository ?
            $this->repository->getQuery($ormQueryBuilder, $this->queryPartialLoad) :
            $ormQueryBuilder->getQuery();

        // Paginate
        $paginator = $this->paginator->paginate(
            $query,
            $requestQuery->page->getValue(),
            $requestQuery->limit->getValue(),
            [
                'pageParameterName' => $requestQuery->page->getQueryKey()
            ]
        );

        $paginatorData = $paginator->getPaginationData();

        if ($paginatorData['lastPageInRange'] < $requestQuery->page->getValue()) {
            throw new HttpException(
                Codes::HTTP_BAD_REQUEST,
                sprintf(
                    'Page number \'%d\' is out of the page range [%d-%d]',
                    $requestQuery->page->getValue(),
                    $paginatorData['firstPageInRange'],
                    $paginatorData['lastPageInRange']
                )
            );
        }

        $paginator->setCustomParameters([
            'filters' => $requestQuery->hasFilters() ? $requestQuery->filters : null,
            'sort' => $requestQuery->hasSort() ? $requestQuery->sort : null,
            'limit' => $requestQuery->hasLimit() ? $requestQuery->limit : null,
        ]);

        return $paginator;
    }

}
