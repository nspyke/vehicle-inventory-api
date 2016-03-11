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


use ApiBundle\Request\Query\Page;

class PageTest extends \PHPUnit_Framework_TestCase {
    
    public function testDefaultPage()
    {
        $page = new Page();

        $this->assertEquals(1, $page->getValue());
        $this->assertEquals('_page', $page->getQueryKey());
    }

    public function testAlternatePage()
    {
        $page = new Page(4);

        $this->assertEquals(4, $page->getValue());
        $this->assertEquals('_page', $page->getQueryKey());
    }

    public function testAlternatePageAlternateKey()
    {
        $page = new Page(20,'key');

        $this->assertEquals(20, $page->getValue());
        $this->assertEquals('key', $page->getQueryKey());
    }

    public function testToString()
    {
        $page = new Page(4);

        $this->assertEquals('_page=4', (string)$page);
    }

    public function testToArray()
    {
        $page = new Page(4);

        $this->assertEquals(['_page' => 4], $page->toArray());
    }
}
