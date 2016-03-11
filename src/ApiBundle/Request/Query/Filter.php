<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category request query
 * @since 2015.05.13
 */

namespace ApiBundle\Request\Query;


class Filter implements RequestQueryInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $queryKey;

    /**
     * @param mixed $value
     * @param string $queryKey
     */
    public function __construct($value, $queryKey)
    {
        $this->value = $value;
        $this->queryKey = $queryKey;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->queryKey.'='.$this->value;
    }

    public function toArray()
    {
        return [$this->queryKey => $this->value];
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getQueryKey()
    {
        return $this->queryKey;
    }
}