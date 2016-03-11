<?php
/**
 * View Factory class to prepare view models for the serializer
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category view
 * @since 2015.05.15
 */

namespace ApiBundle\View\Factory;


use ApiBundle\View\Base;
use ApiBundle\View\Data;
use ApiBundle\View\Error;
use FOS\RestBundle\Util\ExceptionWrapper;
use IMS\CommonBundle\Entity\EntityInterface;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Pagination\AbstractPagination;
use Symfony\Component\Routing\RouterInterface;

class ViewFactory
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Routing\Router
     */
    protected $router;

    /**
     * @param RouterInterface $router
     */
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * @param AbstractPagination $pagination
     * @param array $routeParams
     * @return Base
     */
    public function createPaginatedView(AbstractPagination $pagination, $routeParams)
    {
        $data = $this->createData($pagination->getItems());

        if ($pagination instanceof SlidingPagination) {
            $data = $this->applySlidingPaginationPaging($pagination, $data, $routeParams);
        } else {
            $data = $this->applyBasicPaginationPaging($pagination, $data);
        }

        return $this->createBase($data);
    }

    /**
     * @param EntityInterface $entity
     * @return Base
     */
    public function createSingleView(EntityInterface $entity)
    {
        $data = $this->createData([$entity]);
        $data->id = $entity->getId();

        if (method_exists($entity, 'getDateUpdated')) {
            $data->updated = $entity->getDateUpdated();
        }

        return $this->createBase($data);
    }

    /**
     * @param mixed $items
     * @return Base
     */
    public function createView($items)
    {
       return $this->createBase($this->createData($items));
    }

    /**
     * @param $error
     * @return Base
     */
    public function createErrorView($error)
    {
        return $this->createBase(null, $error);
    }

    /**
     * @param $items
     * @return Data
     */
    protected function createData($items)
    {
        $data = new Data();
        $data->items = $items;

        if (count($items)) {
            switch (gettype($items)) {
                case 'array':
                    if (is_object($items[0])) {
                        $data->kind = $this->getClassBaseName($items[0]);
                    } else {
                        $data->kind = gettype($items);
                    }
                    break;
                case 'object':
                    $data->kind = $this->getClassBaseName($items);
                    break;
                default:
                    $data->kind = gettype($items);
            }
        }

        return $data;
    }

    /**
     * @param SlidingPagination $pagination
     * @param Data $data
     * @param array $routeParams
     * @return Data
     */
    protected function applySlidingPaginationPaging(SlidingPagination $pagination, Data $data, array $routeParams = [])
    {
        $data = $this->applyBasicPaginationPaging($pagination, $data);

        $customParameters = $pagination->getCustomParameters();
        $sort = $customParameters['sort'];
        $filters = $customParameters['filters'];
        $limit = $customParameters['limit'];

        $options = $pagination->getPaginatorOptions();
        $pageParameterName = $options['pageParameterName'];

        $params = $pagination->getPaginationData();

        if ($data->totalPages > 0) {
            if ($sort) {
                $routeParams = array_merge($sort->toArray(), $routeParams);
            }

            if ($limit) {
                $routeParams = array_merge($limit->toArray(), $routeParams);
            }

            if ($filters) {
                foreach ($filters as $filter) {
                    $routeParams = array_merge($filter->toArray(), $routeParams);
                }
            }

            if ($data->pageIndex !== $params['first']) {
                $data->previousLink = $this->router->generate(
                    $pagination->getRoute(),
                    array_merge([$pageParameterName => $params['previous']], $routeParams),
                    true
                );
            }

            if ($data->pageIndex !== $params['last']) {
                $data->nextLink = $this->router->generate(
                    $pagination->getRoute(),
                    array_merge([$pageParameterName => $params['next']], $routeParams),
                    true
                );
            }

            $data->pagingLinkTemplate = $this->router->generate(
                $pagination->getRoute(),
                array_merge([$pageParameterName => 'PAGE_NUMBER'], $routeParams),
                true
            );
        }

        return $data;
    }

    /**
     * @param AbstractPagination $pagination
     * @param Data $data
     * @return Data
     */
    protected function applyBasicPaginationPaging(AbstractPagination $pagination, Data $data)
    {
        $data->currentItemCount = $pagination->count();
        $data->itemsPerPage = $pagination->getItemNumberPerPage();
        $data->totalItems = $pagination->getTotalItemCount();
        $data->pageIndex = $pagination->getCurrentPageNumber();
        $data->totalPages = $data->currentItemCount > 0 ? intval(ceil($data->totalItems / $data->currentItemCount)) : null;

        return $data;
    }


    /**
     * @param Data $data
     * @param mixed|ExceptionWrapper $error
     * @return Base
     */
    protected function createBase(Data $data = null, $error = null)
    {
        $base = new Base();
        $base->data = $data;
        $base->error = $error;

        return $base;
    }

    /**
     * @param $class
     * @return mixed
     */
    protected function getClassBaseName($class)
    {
        $parts = explode('\\', get_class($class));

        return array_pop($parts);
    }
}