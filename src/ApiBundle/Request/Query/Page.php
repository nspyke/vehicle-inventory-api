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


class Page implements RequestQueryInterface
{
    const DEFAULT_VALUE = 1;
    const QUERY_KEY = '_page';

    /**
     * @var int
     */
    protected $value;

    /**
     * @var string
     */
    protected $queryKey;

    /**
     * @param int $value
     * @param string $queryKey
     */
    public function __construct($value = null, $queryKey = null)
    {
        if (!is_numeric($value) or empty($value)) {
            $value = self::DEFAULT_VALUE;
        }

        if (empty($queryKey)) {
            $queryKey = self::QUERY_KEY;
        }

        $this->value = intval($value);
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