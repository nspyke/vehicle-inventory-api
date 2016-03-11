<?php
/**
 * EngineHandler Test
 *
 * @author Nik Spijkerman <nikolas.spijkerman@gmail.com>
 * @package api
 * @category test
 * @since 2015.05.29
 */
namespace ApiBundle\Tests\Handler;

use ApiBundle\Form\EngineType;
use Mockery as m;
use ApiBundle\Handler\EngineHandler;
use IMS\CommonBundle\Entity\Engine;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Component\HttpFoundation\Request;

class EngineHandlerTest extends BaseTestHandler
{
    public function setUp()
    {
        $this->className = 'IMS\CommonBundle\Entity\Engine';
        $this->repoName = 'AppBundle\Repository\EngineRepository';

        parent::setUp();
    }

    public function testGetList()
    {
        $request = $this->createQueryRequest(10, 1, 'field1', 0);

        $handler = new EngineHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);

        $this->assertInstanceOf(SlidingPagination::class, $list);

    }

    public function testGetOneById()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(new Engine());

        $this->repo
            ->shouldReceive('findByQuery')->with(1)->andReturn($this->query);

        $handler = new EngineHandler($this->em, $this->className);
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

        $handler = new EngineHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneById(1);
    }

    public function testGetOneBy()
    {
        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(new Engine());

        $this->repo
            ->shouldReceive('findByQuery')->with('value', 'column')->andReturn($this->query);

        $handler = new EngineHandler($this->em, $this->className);
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

        $handler = new EngineHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneBy('column', 'value');
    }

    public function testPost()
    {
        $method = 'POST';
        $request = m::mock(Request::class);

        $this->setUpProcessForm($request, $method, EngineType::class);

        $handler = new EngineHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->post($request);

        $this->assertInstanceOf($this->className, $result);
    }


    public function testPatch()
    {
        $id = 1;

        $this->query
            ->shouldReceive('getOneOrNullResult')->andReturn(new Engine());

        $this->repo
            ->shouldReceive('findByQuery')->with(1)->andReturn($this->query);

        $method = 'PATCH';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, EngineType::class);

        $handler = new EngineHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->patch($id, $request);

        $this->assertInstanceOf($this->className, $result);
    }


    public function testPutUpdating()
    {
        $id = 1;

        $this->repo
            ->shouldReceive('find')->with($id)->andReturn(new Engine());

        $method = 'PUT';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, EngineType::class);

        $handler = new EngineHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->put($id, $request);

        $this->assertInstanceOf($this->className, $result->entity);
        $this->assertTrue($result->isUpdate());
    }

    public function testPutCreating()
    {
        $id = 1;

        $this->repo
            ->shouldReceive('find')->with($id)->andReturn(null);

        $method = 'PUT';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, EngineType::class);

        $handler = new EngineHandler($this->em, $this->className);
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
        $handler = new EngineHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $handler->delete(1);
    }

}
