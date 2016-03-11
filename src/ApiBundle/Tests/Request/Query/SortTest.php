<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.14
 */

namespace ApiBundle\Tests\Request\Query;


use ApiBundle\Request\Query\Sort;

class SortTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $string
     * @param $values
     * @dataProvider dataProvider
     */
    public function testGetValue($string, $values)
    {
        $sort = new Sort($string);

        $this->assertEquals($values, $sort->getValue());

    }

    /**
     * @param $string
     * @param $values
     * @dataProvider dataProvider
     */
    public function testGetRawValue($string, $values)
    {
        $sort = new Sort($string);

        $this->assertEquals($string, $sort->getRawValue());
    }

    public function testDefaultGetQueryKey()
    {
        $sort = new Sort('key1');

        $this->assertEquals('_sort', $sort->getQueryKey());
    }

    public function testAlternateGetQueryKey()
    {
        $sort = new Sort('key1', 'sortby');

        $this->assertEquals('sortby', $sort->getQueryKey());
    }

    public function testToString()
    {
        $sort = new Sort('key1,-key2');

        $this->assertEquals('_sort=key1,-key2', (string)$sort);
    }

    public function testToArray()
    {
        $sort = new Sort('key1,-key2');

        $this->assertEquals(['_sort' => 'key1,-key2'], $sort->toArray());
    }

    public function dataProvider()
    {
        return [
            ['key1',['key1' => 'asc']],
            ['-key1',['key1' => 'desc']],
            ['key1,key2', ['key1' => 'asc', 'key2' => 'asc']],
            ['-key1,-key2', ['key1' => 'desc', 'key2' => 'desc']],
            ['key1,-key2', ['key1' => 'asc', 'key2' => 'desc']],
        ];
    }
}
