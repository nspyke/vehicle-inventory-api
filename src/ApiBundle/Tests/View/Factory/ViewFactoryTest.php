<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.18
 */

namespace ApiBundle\Tests\View\Factory;

use ApiBundle\Request\Query\Filter;
use ApiBundle\Request\Query\Limit;
use ApiBundle\Request\Query\Sort;
use ApiBundle\Tests\TestEntity;
use ApiBundle\View\Factory\ViewFactory;
use IMS\CommonBundle\Entity\EntityInterface;
use Mockery as m;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use ApiBundle\View\Data;
use ApiBundle\View\Base;

class ViewFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var m\Mock
     */
    private $router;

    public function setUp()
    {
        $this->router = m::mock(Router::class);
    }

    public function dp1()
    {
        return [
            [m::mock(SlidingPagination::class)],
            [m::mock('Knp\Component\Pager\Pagination\AbstractPagination')],
        ];
    }

    /**
     * @param $paginator
     * @dataProvider dp1
     */
    public function testCreatePaginationView($paginator)
    {
        $this->router->shouldReceive('generate')->andReturn('http://url/endpoint?_page=1');
        $paginator->shouldReceive('getItems')->once()->andReturn([
            ['name' => 'blah', 'id' => 1],
            ['name' => 'blah2', 'id' => 2],
        ]);
        $paginator->shouldReceive('count')->once()->andReturn(2);
        $paginator->shouldReceive('getItemNumberPerPage')->once()->andReturn(5);
        $paginator->shouldReceive('getTotalItemCount')->once()->andReturn(2);
        $paginator->shouldReceive('getCurrentPageNumber')->once()->andReturn(1);
        $paginator->shouldReceive('getCustomParameters')->once()->andReturn([
            'sort' => m::mock(Sort::class, ['value'])
                ->shouldReceive('toArray')->andReturn(['_sort' => 'value'])->getMock(),
            'filters' => [
                m::mock(Filter::class, ['value', 'column'])
                    ->shouldReceive('toArray')->andReturn(['column' => 'value'])->getMock()
            ],
            'limit' => m::mock(Limit::class, [10])
                ->shouldReceive('toArray')->andReturn(['_limit' => 10])->getMock(),
        ]);
        $paginator->shouldReceive('getPaginatorOptions')->once()->andReturn([
            'pageParameterName' => '_page'
        ]);
        $paginator->shouldReceive('getPaginationData')->once()->andReturn(1);
        $paginator->shouldReceive('getRoute')->andReturn('endpoint_list');

        $factory = new ViewFactory($this->router);

        $list = $factory->createPaginatedView($paginator, []);

        $this->assertInstanceOf(Base::class, $list);
        $this->assertInstanceOf(Data::class, $list->data);
        $this->assertCount(2, $list->data->items);
        $this->assertEquals(2, $list->data->totalItems);
    }

    public function testCreateSingleView()
    {
        $factory = new ViewFactory($this->router);
        $entity = new TestEntity(1, 'test1', \DateTime::createFromFormat('Y-m-d', '2015-01-01'));
        $view = $factory->createSingleView($entity);
        $this->assertInstanceOf(Base::class, $view);
        $this->assertInstanceOf(Data::class, $view->data);
        $this->assertCount(1, $view->data->items);
        $this->assertEquals(1, $view->data->items[0]->getId());
        $this->assertEquals('test1', $view->data->items[0]);
        $this->assertEquals('2015-01-01', $view->data->updated->format('Y-m-d'));
    }

    public function testCreateView()
    {
        $factory = new ViewFactory($this->router);
        $view = $factory->createView([
            ['id' => 1,'name' => 'test1'],
            ['id' => 2,'name' => 'test2'],
            ['id' => 3,'name' => 'test3'],
        ]);
        $this->assertInstanceOf(Base::class, $view);
        $this->assertInstanceOf(Data::class, $view->data);
        $this->assertCount(3, $view->data->items);
        $this->assertEquals(1, $view->data->items[0]['id']);
        $this->assertEquals('test1', $view->data->items[0]['name']);
    }

    public function testCreateViewWithObject()
    {
        $obj = (object)['id' => 1,'name' => 'test1'];
        $factory = new ViewFactory($this->router);
        $view = $factory->createView($obj);
        $this->assertInstanceOf(Base::class, $view);
        $this->assertInstanceOf(Data::class, $view->data);
    }

    public function testCreateViewWithOtherType()
    {
        $factory = new ViewFactory($this->router);
        $view = $factory->createView('asdfffffffffff234q34');
        $this->assertInstanceOf(Base::class, $view);
        $this->assertInstanceOf(Data::class, $view->data);
    }

    public function testCreateErrorView()
    {
        $factory = new ViewFactory($this->router);
        $view = $factory->createErrorView([
            'code' => 400,
            'message' => 'Message'
        ]);
        $this->assertInstanceOf(Base::class, $view);
        $this->assertNull($view->data);
        $this->assertEquals([
            'code' => 400,
            'message' => 'Message'
        ], $view->error);
    }

}

