<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.13
 */

namespace ApiBundle\Tests\Request\Query;


use ApiBundle\Request\Query\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    public function testFilter()
    {
        $filter = new Filter('value', 'key');

        $this->assertEquals('value', $filter->getValue());
        $this->assertEquals('key', $filter->getQueryKey());
    }

    public function testToString()
    {
        $filter = new Filter('value', 'key');
        $this->assertEquals('key=value', (string)$filter);
    }

    public function testToArray()
    {
        $filter = new Filter('value', 'key');
        $this->assertEquals(['key' => 'value'], $filter->toArray());
    }


}
