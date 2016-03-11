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


class Sort implements RequestQueryInterface
{
    const QUERY_KEY = '_sort';

    /**
     * @var null|string
     */
    protected $queryKey;

    /**
     * @var array
     */
    protected $value;

    /**
     * @var string
     */
    protected $rawValue;

    /**
     * @param null $value
     * @param string $queryKey
     */
    public function __construct($value, $queryKey = null)
    {
        if (empty($queryKey)) {
            $queryKey = self::QUERY_KEY;
        }

        $this->queryKey = $queryKey;
        $this->rawValue = $value;
        $this->value = $this->parse($value);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->queryKey.'='.$this->rawValue;
    }

    public function toArray()
    {
        return [$this->queryKey => $this->rawValue];
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

    public function getRawValue()
    {
        return $this->rawValue;
    }

    /**
     * Parses the sort query parameter value.
     * Sort direction is defined by appending a '-' to the column name.
     * Multiple sorts can be applied by comma separation.
     * eg. _sort=-createdAt,lastName
     * In the example above, createdAt is DESC, lastName is ASC
     *
     * @param string $value
     * @return array
     */
    protected function parse($value)
    {
        $sort = [];

        foreach (explode(',', $value) as $v) {
            if (substr_compare($v, '-', 0, 1) === 0) {
                $key = substr($v, 1);
                $direction = 'desc';
            } else {
                $key = $v;
                $direction = 'asc';
            }
            $sort[$key] = $direction;
        }

        return $sort;
    }
}