<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.14
 */

namespace ApiBundle\Tests\Request;

use ApiBundle\Request\Query;
use ApiBundle\Request\Query\Limit;
use ApiBundle\Request\Query\Sort;
use ApiBundle\Request\Query\Filter;
use ApiBundle\Request\Query\Page;
use Mockery as m;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class QueryTest extends \PHPUnit_Framework_TestCase
{
    public function testToString()
    {
        $values = ['_sort' => 'column', '_limit' => 15, '_page' => 2, 'filter1' => 'val1', 'filter2' => 'val2'];
        $bag = m::mock(ParameterBag::class, $values);
        $bag->shouldReceive('all')->once()->andReturn($values);
        $query = new Query($bag);

        $this->assertEquals('_sort=column&_limit=15&_page=2&filter1=val1&filter2=val2', (string)$query);
    }

    public function testQueryWithLimit()
    {
        $value = 10;
        $bag = m::mock(ParameterBag::class, ['_limit' => $value]);
        $bag->shouldReceive('has')->with('_limit')->andReturn(true);
        $bag->shouldReceive('has')->with('_sort' OR '_page')->andReturn(false);
        $bag->shouldReceive('get')->with('_limit')->once()->andReturn($value);
        $bag->shouldReceive('remove')->with('_limit')->once();
        $bag->shouldReceive('count')->once()->andReturn(0);

        $query = (new Query($bag))->parse();

        $this->assertInstanceOf(Limit::class, $query->limit);
        $this->assertEquals($value, $query->limit->getValue());

        $this->assertInstanceOf(Page::class, $query->page);
        $this->assertNull($query->sort);
        $this->assertNull($query->filters);
    }

    public function testQueryWithPage()
    {
        $value = 1;
        $bag = m::mock(ParameterBag::class, ['_page' => $value]);
        $bag->shouldReceive('has')->with('_page')->andReturn(true);
        $bag->shouldReceive('has')->with('_sort' OR '_limit')->andReturn(false);
        $bag->shouldReceive('get')->with('_page')->once()->andReturn($value);
        $bag->shouldReceive('remove')->with('_page')->once();
        $bag->shouldReceive('count')->once()->andReturn(0);

        $query = (new Query($bag))->parse();

        $this->assertInstanceOf(Page::class, $query->page);
        $this->assertEquals($value, $query->page->getValue());

        $this->assertInstanceOf(Limit::class, $query->limit);
        $this->assertNull($query->sort);
        $this->assertNull($query->filters);
    }

    public function testQueryWithSort()
    {
        $value = 'key,-key1';
        $bag = m::mock(ParameterBag::class, ['_sort' => $value]);
        $bag->shouldReceive('has')->with('_sort')->andReturn(true);
        $bag->shouldReceive('has')->with('_limit' OR '_page')->andReturn(false);
        $bag->shouldReceive('get')->with('_sort')->once()->andReturn($value);
        $bag->shouldReceive('remove')->with('_sort')->once();
        $bag->shouldReceive('count')->once()->andReturn(0);

        $query = (new Query($bag))->parse();

        $this->assertInstanceOf(Sort::class, $query->sort);
        $this->assertEquals(['key' => 'asc', 'key1' => 'desc'], $query->sort->getValue());

        $this->assertInstanceOf(Page::class, $query->page);
        $this->assertInstanceOf(Limit::class, $query->limit);
        $this->assertNull($query->filters);
    }

    /**
     * @param $count
     * @param $values
     * @dataProvider filtersDataProvider
     */
    public function testQueryWithFilters($count, $values)
    {
        $bag = m::mock(ParameterBag::class, $values);
        $bag->shouldReceive('has')->with('_limit' OR '_page' OR '_sort')->andReturn(false);
        $bag->shouldReceive('count')->once()->andReturn($count);
        $bag->shouldReceive('all')->once()->andReturn($values);

        $query = (new Query($bag))->parse();

        $this->assertInternalType('array', $query->filters);
        $this->assertCount($count, $query->filters);

        $expected = [];
        foreach ($values as $key => $value) {
            $expected[] = ['k' => $key, 'v' => $value];
        }

        /** @var Filter $filter */
        $i = 0;
        foreach ($query->filters as $filter) {
            $this->assertInstanceOf(Filter::class, $filter);
            $this->assertEquals($expected[$i]['v'], $filter->getValue());
            $this->assertEquals($expected[$i]['k'], $filter->getQueryKey());
            $i++;
        }

        $this->assertInstanceOf(Page::class, $query->page);
        $this->assertInstanceOf(Limit::class, $query->limit);
        $this->assertNull($query->sort);
    }

    public function testQueryWithLimitAndPageAndSort()
    {
        $bag = m::mock(ParameterBag::class, ['_sort' => 'column', '_limit' => 15, '_page' => 2]);
        $bag->shouldReceive('has')->with('_sort' OR '_limit' OR '_page')->andReturn(true);
        $bag->shouldReceive('get')->with('_sort')->andReturn('column');
        $bag->shouldReceive('get')->with('_limit')->andReturn(15);
        $bag->shouldReceive('get')->with('_page')->andReturn(2);
        $bag->shouldReceive('remove')->with('_sort' OR '_limit' OR '_page')->times(3);
        $bag->shouldReceive('count')->once()->andReturn(0);

        $query = (new Query($bag))->parse();

        $this->assertInstanceOf(Sort::class, $query->sort);
        $this->assertEquals(['column' => 'asc'], $query->sort->getValue());

        $this->assertInstanceOf(Page::class, $query->page);
        $this->assertEquals(2, $query->page->getValue());

        $this->assertInstanceOf(Limit::class, $query->limit);
        $this->assertEquals(15, $query->limit->getValue());
    }

    public function testQueryWithCustomLimitPageAndSortKeys()
    {
        $bag = m::mock(ParameterBag::class, ['sorting' => 'column', 'limiting' => 15, 'paging' => 2]);
        $bag->shouldReceive('has')->with('sorting' OR 'limiting' OR 'paging')->andReturn(true);
        $bag->shouldReceive('get')->with('sorting')->andReturn('column');
        $bag->shouldReceive('get')->with('limiting')->andReturn(15);
        $bag->shouldReceive('get')->with('paging')->andReturn(2);
        $bag->shouldReceive('remove')->with('sorting' OR 'limiting' OR 'paging')->times(3);
        $bag->shouldReceive('count')->once()->andReturn(0);

        $query = (new Query($bag, 'limiting', 'sorting', 'paging'))->parse();

        $this->assertInstanceOf(Sort::class, $query->sort);
        $this->assertEquals(['column' => 'asc'], $query->sort->getValue());

        $this->assertInstanceOf(Page::class, $query->page);
        $this->assertEquals(2, $query->page->getValue());

        $this->assertInstanceOf(Limit::class, $query->limit);
        $this->assertEquals(15, $query->limit->getValue());
    }

    public function testQueryWithLimitAndPageAndSortAndFilters()
    {
        $bag = m::mock(ParameterBag::class, ['_sort' => 'column', '_limit' => 15, '_page' => 2, 'filter1' => 'val1', 'filter2' => 'val2']);
        $bag->shouldReceive('has')->with('_sort' OR '_limit' OR '_page')->andReturn(true);
        $bag->shouldReceive('get')->with('_sort')->andReturn('column');
        $bag->shouldReceive('get')->with('_limit')->andReturn(15);
        $bag->shouldReceive('get')->with('_page')->andReturn(2);
        $bag->shouldReceive('remove')->with('_sort' OR '_limit' OR '_page')->times(3);
        $bag->shouldReceive('count')->once()->andReturn(2);
        $bag->shouldReceive('all')->once()->andReturn(['filter1' => 'val1', 'filter2' => 'val2']);

        $query = (new Query($bag))->parse();

        $this->assertInstanceOf(Sort::class, $query->sort);
        $this->assertEquals(['column' => 'asc'], $query->sort->getValue());

        $this->assertInstanceOf(Page::class, $query->page);
        $this->assertEquals(2, $query->page->getValue());

        $this->assertInstanceOf(Limit::class, $query->limit);
        $this->assertEquals(15, $query->limit->getValue());

        $this->assertInternalType('array', $query->filters);
        $this->assertCount(2, $query->filters);

        $i = 0;
        $expected = [];
        $expected[] = ['k' => 'filter1', 'v' => 'val1'];
        $expected[] = ['k' => 'filter2', 'v' => 'val2'];

        foreach ($query->filters as $filter) {
            $this->assertInstanceOf(Filter::class, $filter);
            $this->assertEquals($expected[$i]['v'], $filter->getValue());
            $this->assertEquals($expected[$i]['k'], $filter->getQueryKey());
            $i++;
        }
    }

    public function testHasSort()
    {
        $bag = m::mock(ParameterBag::class, ['_sort' => 'column', '_limit' => 15, '_page' => 2, 'filter1' => 'val1', 'filter2' => 'val2']);
        $bag->shouldReceive('has')->with('_sort' OR '_limit' OR '_page')->andReturn(true);
        $bag->shouldReceive('get')->with('_sort')->andReturn('column');
        $bag->shouldReceive('get')->with('_limit')->andReturn(15);
        $bag->shouldReceive('get')->with('_page')->andReturn(2);
        $bag->shouldReceive('remove')->with('_sort' OR '_limit' OR '_page')->times(3);
        $bag->shouldReceive('count')->once()->andReturn(2);
        $bag->shouldReceive('all')->once()->andReturn(['filter1' => 'val1', 'filter2' => 'val2']);

        $query = (new Query($bag))->parse();

        $this->assertTrue($query->hasSort());
    }

    public function testHasFilters()
    {
        $bag = m::mock(ParameterBag::class, ['_sort' => 'column', '_limit' => 15, '_page' => 2, 'filter1' => 'val1', 'filter2' => 'val2']);
        $bag->shouldReceive('has')->with('_sort' OR '_limit' OR '_page')->andReturn(true);
        $bag->shouldReceive('get')->with('_sort')->andReturn('column');
        $bag->shouldReceive('get')->with('_limit')->andReturn(15);
        $bag->shouldReceive('get')->with('_page')->andReturn(2);
        $bag->shouldReceive('remove')->with('_sort' OR '_limit' OR '_page')->times(3);
        $bag->shouldReceive('count')->once()->andReturn(2);
        $bag->shouldReceive('all')->once()->andReturn(['filter1' => 'val1', 'filter2' => 'val2']);

        $query = (new Query($bag))->parse();

        $this->assertTrue($query->hasFilters());
    }

    public function testHasLimit()
    {
        $bag = m::mock(ParameterBag::class, ['_sort' => 'column', '_limit' => 15, '_page' => 2, 'filter1' => 'val1', 'filter2' => 'val2']);
        $bag->shouldReceive('has')->with('_sort' OR '_limit' OR '_page')->andReturn(true);
        $bag->shouldReceive('get')->with('_sort')->andReturn('column');
        $bag->shouldReceive('get')->with('_limit')->andReturn(15);
        $bag->shouldReceive('get')->with('_page')->andReturn(2);
        $bag->shouldReceive('remove')->with('_sort' OR '_limit' OR '_page')->times(3);
        $bag->shouldReceive('count')->once()->andReturn(2);
        $bag->shouldReceive('all')->once()->andReturn(['filter1' => 'val1', 'filter2' => 'val2']);

        $query = (new Query($bag))->parse();

        $this->assertTrue($query->hasLimit());
    }

    public function filtersDataProvider()
    {
        return [
            [1, ['key' => 'val']],
            [2, ['key' => 'val', 'key2' => 'val2']],
            [3, ['key' => 'val', 'key2' => 'val2', 'key3' => 'val3']],
        ];
    }


}
