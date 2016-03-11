<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.13
 */

namespace ApiBundle\Request\Query;


interface RequestQueryInterface
{
    /**
     * @param mixed $value
     * @param string $queryKey
     */
    public function __construct($value, $queryKey);

    /**
     * @return string
     */
    public function __toString();

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function getQueryKey();
}