<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.14
 */

namespace ApiBundle\Request;


use ApiBundle\Request\Query\Filter;
use ApiBundle\Request\Query\Limit;
use ApiBundle\Request\Query\Page;
use ApiBundle\Request\Query\Sort;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class Query
{
    /**
     * @var Limit
     */
    public $limit;

    /**
     * @var Page
     */
    public $page;

    /**
     * @var null|Sort
     */
    public $sort;

    /**
     * @var null|array
     */
    public $filters;

    /**
     * @var ParameterBag
     */
    protected $parameterBag;

    /**
     * @var string
     */
    protected $limitKey;

    /**
     * @var string
     */
    protected $sortKey;

    /**
     * @var string
     */
    protected $pageKey;

    /**
     * @param ParameterBag $parameterBag
     * @param string $limitKey
     * @param string $sortKey
     * @param string $pageKey
     */
    public function __construct(ParameterBag $parameterBag, $limitKey = null, $sortKey = null, $pageKey = null)
    {
        $this->parameterBag = $parameterBag;
        // Set the keys if they haven't been defined
        $this->limitKey = $limitKey ?: Limit::QUERY_KEY;
        $this->sortKey = $sortKey ?: Sort::QUERY_KEY;
        $this->pageKey = $pageKey ?: Page::QUERY_KEY;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $str = '';

        foreach ($this->parameterBag->all() as $key => $value) {
            $str .= $key.'='.$value.'&';
        }

        $str = rtrim($str, '&');

        return $str;
    }

    /**
     * @return $this
     */
    public function parse()
    {
        $parameterBag = clone $this->parameterBag;

        if ($parameterBag->has($this->limitKey)) {
            $this->limit = new Limit($parameterBag->get($this->limitKey), $this->limitKey);
            $parameterBag->remove($this->limitKey);
        } else {
            $this->limit = new Limit();
        }

        if ($parameterBag->has($this->sortKey)) {
            $this->sort = new Sort($parameterBag->get($this->sortKey), $this->sortKey);
            $parameterBag->remove($this->sortKey);
        }

        if ($parameterBag->has($this->pageKey)) {
            $this->page = new Page($parameterBag->get($this->pageKey), $this->pageKey);
            $parameterBag->remove($this->pageKey);
        } else {
            $this->page = new Page();
        }

        if ($parameterBag->count() > 0) {
            $this->filters = [];
            foreach ($parameterBag->all() as $filterKey => $filterValue) {
                $this->filters[] = new Filter($filterValue, $filterKey);
            }
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function hasSort()
    {
        return $this->sort instanceof Sort;
    }

    /**
     * @return bool
     */
    public function hasFilters()
    {
        return (bool)count($this->filters);
    }

    /**
     * @return bool
     */
    public function hasLimit()
    {
        return $this->parameterBag->has($this->limitKey);
    }
}