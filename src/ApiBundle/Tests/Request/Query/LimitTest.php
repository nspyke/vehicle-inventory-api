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


use ApiBundle\Request\Query\Limit;

class LimitTest extends \PHPUnit_Framework_TestCase {

    public function testDefaultLimit()
    {
        $filter = new Limit();

        $this->assertEquals(10, $filter->getValue());
        $this->assertEquals('_limit', $filter->getQueryKey());
    }

    public function testAlternateLimit()
    {
        $filter = new Limit(20);

        $this->assertEquals(20, $filter->getValue());
        $this->assertEquals('_limit', $filter->getQueryKey());
    }

    public function testAlternateLimitAlternateKey()
    {
        $filter = new Limit(20,'key');

        $this->assertEquals(20, $filter->getValue());
        $this->assertEquals('key', $filter->getQueryKey());
    }

    public function testToString()
    {
        $limit = new Limit(10);

        $this->assertEquals('_limit=10', (string)$limit);
    }

    public function testToArray()
    {
        $limit = new Limit(10);

        $this->assertEquals(['_limit' => 10], $limit->toArray());
    }



}
