<?php
/**
 *
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package
 * @category
 * @since 2015.05.20
 */

namespace ApiBundle\Tests\Handler;

use ApiBundle\Form\VehicleType;
use ApiBundle\Handler\VehicleHandler;
use AppBundle\Exception\InvalidFormException;
use IMS\CommonBundle\Entity\Vehicle;
use Mockery as m;
use Symfony\Component\HttpFoundation\Request;

class AbstractTestHandlerTest extends BaseTestHandler
{

    public function setUp()
    {
        $this->className = 'ApiBundle\Tests\TestEntity';
        $this->repoName = 'AppBundle\Repository\VehicleRepository';
        parent::setUp();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testConstructorThrowsException()
    {
        m::mock('ApiBundle\Handler\AbstractHandler', [
            $this->em,
            'NonExistantClass',
            $this->formFactory
        ]);
    }

    public function testGetPaginator()
    {
        $p = $this->createPaginator(10, 1);
        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $handler->setPaginator($p);
        $this->assertEquals($p, $handler->getPaginator());
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testOutOfPageRangeThrowsException()
    {
        $request = $this->createQueryRequest(10, 8, 'field1', 0);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 8);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testInvalidSortColumnThrowsException()
    {
        $request = $this->createQueryRequest(10, 1, 'invalidcolumn', 0);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);
    }

    /**
     * @dataProvider dataProviderForTestHandleListWithScalarFilter
     */
    public function testHandleListWithScalarFilter($value)
    {
        $a = $this->rootAlias;
        $request = $this->createQueryRequest(10, 1, 'field1', 1, ['field1' => $value]);

        $this->meta
            ->shouldReceive('isCollectionValuedAssociation')->with('field1')->andReturn(false);

        $comp = m::mock('Doctrine\ORM\Query\Expr\Comparison', [$a . '.field1', '=', ':field1']);
        $expr = m::mock('Doctrine\ORM\Query\Expr')
            ->shouldReceive('eq')->times(is_array($value) ? 0 : 1)->andReturn($comp)->getMock()
            ->shouldReceive('in')->times(is_array($value) ? 1 : 0)->andReturn($comp)->getMock();

        $this->queryBuilder
            ->shouldReceive('expr')->once()->andReturn($expr)->getMock()
            ->shouldReceive('andWhere')->with($comp)->once()->getMock()
            ->shouldReceive('setParameter')->with(':field1', $value)->once()->getMock();

        $this->query
            ->shouldReceive('setHint')->once();

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);
    }

    public function dataProviderForTestHandleListWithScalarFilter()
    {
        return [
            ['val'],
            [['val1', 'val2']]
        ];
    }

    public function testHandleListWithCollectionFilter()
    {
        $a = $this->rootAlias;
        $request = $this->createQueryRequest(10, 1, 'field1', 1, ['assoc1' => 1]);

        $this->meta
            ->shouldReceive('isCollectionValuedAssociation')->with('assoc1')->andReturn(true);

        $func = m::mock('Doctrine\ORM\Query\Expr\Func', [$a . '.assoc1', 'IN', ':assoc1']);
        $expr = m::mock('Doctrine\ORM\Query\Expr')
            ->shouldReceive('in')->once()->andReturn($func)->getMock();

        $this->queryBuilder
            ->shouldReceive('expr')->once()->andReturn($expr)->getMock()
            ->shouldReceive('leftJoin')->with($a . '.assoc1', 'assoc1')->once()->getMock()
            ->shouldReceive('andWhere')->with($func)->once()->getMock()
            ->shouldReceive('setParameter')->with(':assoc1', 1)->once()->getMock();

        $this->query
            ->shouldReceive('setHint')->once();

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testHandleListWithCollectionFilterThrowsException()
    {
        $a = $this->rootAlias;
        $request = $this->createQueryRequest(10, 1, 'field1', 1, ['assoc1' => 'asdaas']);

        $this->meta
            ->shouldReceive('isCollectionValuedAssociation')->with('assoc1')->andReturn(true);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);
    }


    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function testHandleListInvalidFilterThrowsHttpException()
    {
        $request = $this->createQueryRequest(10, 1, 'field1', 1, ['invalidfield1' => 'val']);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);
    }

    /**
     * @expectedException \AppBundle\Exception\InvalidFormException
     */
    public function testInvalidProcessForm()
    {
        $method = 'POST';
        $request = m::mock(Request::class);

        $form = m::mock()
            ->shouldReceive('handleRequest')->with($request)->getMock()
            ->shouldReceive('isValid')->andReturn(false)->getMock();

        $this->formFactory
            ->shouldReceive('create')->with(
                anInstanceOf(VehicleType::class), anInstanceOf(Vehicle::class), ['method' => $method]
            )->andReturn($form)->getMock();

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->post($request);

    }
}
