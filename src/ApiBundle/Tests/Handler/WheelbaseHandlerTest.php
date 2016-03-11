<?php
/**
 * WheelbaseHandler Test
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category test
 * @since 2015.05.29
 */
namespace ApiBundle\Tests\Handler;

use ApiBundle\Form\WheelbaseType;
use Mockery as m;
use ApiBundle\Handler\WheelbaseHandler;
use IMS\CommonBundle\Entity\Wheelbase;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Symfony\Component\HttpFoundation\Request;

class WheelbaseHandlerTest extends BaseTestHandler
{
    public function setUp()
    {
        $this->className = 'IMS\CommonBundle\Entity\Wheelbase';
        $this->repoName = 'Doctrine\ORM\EntityRepository';

        parent::setUp();
    }

    public function testGetList()
    {
        $request = $this->createQueryRequest(10, 1, 'field1', 0);

        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $paginator = $this->createPaginator(10, 1);

        $handler->setPaginator($paginator);

        $list = $handler->getList($request);

        $this->assertInstanceOf(SlidingPagination::class, $list);

    }

    public function testGetOneById()
    {
        $this->repo
            ->shouldReceive('find')->with(1)->andReturn(new Wheelbase());

        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneById(1);

        $this->assertInstanceOf($this->className, $entity);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetOneByIdThrowsExceptionWhenNull()
    {
        $this->repo
            ->shouldReceive('find')->with(1)->andReturn(null);

        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneById(1);
    }

    public function testGetOneBy()
    {
        $this->repo
            ->shouldReceive('findOneBy')->with(['column' => 'value'])->andReturn(new Wheelbase());

        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneBy('column', 'value');

        $this->assertInstanceOf($this->className, $entity);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function testGetOneByThrowsExceptionWhenNull()
    {
        $this->repo
            ->shouldReceive('findOneBy')->with(['column' => 'value'])->andReturn(null);

        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);

        $entity = $handler->getOneBy('column', 'value');
    }

    public function testPost()
    {
        $method = 'POST';
        $request = m::mock(Request::class);

        $this->setUpProcessForm($request, $method, WheelbaseType::class);

        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->post($request);

        $this->assertInstanceOf($this->className, $result);
    }


    public function testPatch()
    {
        $id = 1;

        $this->repo
            ->shouldReceive('find')->with($id)->andReturn(new Wheelbase());

        $method = 'PATCH';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, WheelbaseType::class);

        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $result = $handler->patch($id, $request);

        $this->assertInstanceOf($this->className, $result);
    }


    public function testPutUpdating()
    {
        $id = 1;

        $this->repo
            ->shouldReceive('find')->with($id)->andReturn(new Wheelbase());

        $method = 'PUT';
        $request = m::mock(Request::class)
            ->shouldReceive('getMethod')->andReturn($method)->getMock();

        $this->setUpProcessForm($request, $method, WheelbaseType::class);

        $handler = new WheelbaseHandler($this->em, $this->className);
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

        $this->setUpProcessForm($request, $method, WheelbaseType::class);

        $handler = new WheelbaseHandler($this->em, $this->className);
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
        $handler = new WheelbaseHandler($this->em, $this->className);
        $handler->setFormFactory($this->formFactory);
        $handler->delete(1);
    }

}
