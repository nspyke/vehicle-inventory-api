<?php

namespace ApiBundle\Tests\Handler;

use ApiBundle\Form\VehicleType;
use Doctrine\ORM\Query;
use IMS\CommonBundle\Entity\Vehicle;
use Mockery as m;
use ApiBundle\Handler\VehicleHandler;
use ApiBundle\Request\Query as RequestQuery;
use Knp\Component\Pager\Paginator;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Component\HttpFoundation\Request;

class VehicleTestHandlerTest extends BaseTestHandler
{
    public function setUp()
    {
        $this->className = 'IMS\CommonBundle\Entity\Vehicle';
        $this->repoName = 'AppBundle\Repository\VehicleRepository';

        parent::setUp();
    }

    public function testGetList()
    {
        $request = $this->createQueryRequest(10, 1, 'field1', 0);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);

        $this->assertInstanceOf(SlidingPagination::class, $list);

    }

    public function testGetOneById()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(new Vehicle());

        $this->repo
            ->shouldReceive('findByQuery')->with(1)->andReturn($this->query);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneById(1);

        $this->assertInstanceOf($this->className, $entity);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetOneByIdThrowsExceptionWhenNull()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(null);

        $this->repo
            ->shouldReceive('findByQuery')->with(1)->andReturn($this->query);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneById(1);
    }

    public function testGetOneBy()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(new Vehicle());

        $this->repo
            ->shouldReceive('findByQuery')->with('value', 'column')->andReturn($this->query);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneBy('column', 'value');

        $this->assertInstanceOf($this->className, $entity);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetOneByThrowsExceptionWhenNull()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(null);

        $this->repo
            ->shouldReceive('findByQuery')->with('value', 'column')->andReturn($this->query);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneBy('column', 'value');
    }

    public function testPost()
    {
        $method = 'POST';
        $request = m::mock(Request::class);

        $this->setUpProcessForm($request, $method, VehicleType::class);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->post($request);

        $this->assertInstanceOf($this->className, $result);
    }

    public function testPatch()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(new Vehicle());

        $this->repo
            ->shouldReceive('findByQuery')->andReturn($this->query);

        $id = 1;
        $method = 'PATCH';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, VehicleType::class);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->patch($id, $request);

        $this->assertInstanceOf($this->className, $result);
    }

    public function testPutUpdating()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(new Vehicle());

        $this->repo
            ->shouldReceive('findByQuery')->andReturn($this->query);

        $id = 1;
        $method = 'PUT';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, VehicleType::class);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->put($id, $request);

        $this->assertInstanceOf($this->className, $result->entity);
        $this->assertTrue($result->isUpdate());
    }

    public function testPutCreating()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(null);

        $this->repo
            ->shouldReceive('findByQuery')->andReturn($this->query);

        $id = 1;
        $method = 'PUT';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, VehicleType::class);

        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->put($id, $request);

        $this->assertInstanceOf($this->className, $result->entity);
        $this->assertTrue($result->isCreate());
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testDelete()
    {
        $handler = new VehicleHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $handler->delete(1);
    }
}
