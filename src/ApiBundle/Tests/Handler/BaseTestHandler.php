<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.19
 */

namespace ApiBundle\Tests\Handler;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query;
use Mockery as m;
use Symfony\Component\HttpFoundation\ParameterBag;
use Knp\Bundle\PaginatorBundle\Pagination\SlidingPagination;
use Knp\Component\Pager\Paginator;

abstract class BaseTestHandler extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected $rootAlias = 't';

    /**
     * @var \Mockery\MockInterface
     */
    protected $em;

    /**
     * @var \Mockery\MockInterface
     */
    protected $repo;

    /**
     * @var string
     */
    protected $repoName;

    /**
     * @var \Mockery\MockInterface
     */
    protected $query;

    /**
     * @var \Mockery\MockInterface
     */
    protected $queryBuilder;

    /**
     * @var \Mockery\MockInterface
     */
    protected $formFactory;

    /**
     * @var string
     */
    protected $className;

    /**
     * @var \Mockery\MockInterface
     */
    protected $meta;

    public function setUp()
    {
        $this->repo = m::mock($this->repoName);

        $this->meta = m::mock(ClassMetadata::class)
            ->shouldReceive('getFieldNames')->andReturn(['field1', 'field2'])->getMock()
            ->shouldReceive('getAssociationNames')->andReturn(['assoc1', 'assoc2'])->getMock()
        ;

        $this->em = m::mock('Doctrine\ORM\EntityManager')
            ->shouldReceive('getRepository')->andReturn($this->repo)->getMock()
            ->shouldReceive('getClassMetadata')->with($this->className)->andReturn($this->meta)->getMock()
        ;

        $this->formFactory = m::mock('Symfony\Component\Form\FormFactory')
            ->shouldReceive('createForm')->andReturn(m::mock('AppBundle\Form\VehicleType'))->getMock()
        ;

        $this->query = m::mock(new Query($this->em));

        $this->queryBuilder = m::mock('Doctrine\ORM\QueryBuilder')
            ->shouldReceive('getRootAliases')->once()->andReturn($this->rootAlias)->getMock()
            ->shouldReceive('getQuery')->once()->andReturn($this->query)->getMock()
            ->shouldReceive('addOrderBy')->once()->getMock()
        ;

        $this->repo
            ->shouldReceive('getQueryBuilder')->with(anything())->andReturn($this->queryBuilder)->getMock()
            ->shouldReceive('createQueryBuilder')->with(stringValue())->andReturn($this->queryBuilder)->getMock()
            ->shouldReceive('getQuery')->andReturn($this->query)->getMock()
        ;
    }

    protected function createQueryRequest($limit, $page, $sort, $count, $filters = [])
    {
        $request = m::mock('Symfony\Component\HttpFoundation\Request');
        $request->query = m::mock(ParameterBag::class)
            ->shouldReceive('remove')->with('_sort' OR '_limit' OR '_page')->getMock()
            ->shouldReceive('get')->with('_limit')->andReturn($limit)->getMock()
            ->shouldReceive('has')->with('_limit')->andReturn(true)->getMock()
            ->shouldReceive('get')->with('_page')->andReturn($page)->getMock()
            ->shouldReceive('has')->with('_page')->andReturn(true)->getMock()
            ->shouldReceive('get')->with('_sort')->andReturn($sort)->getMock()
            ->shouldReceive('has')->with('_sort')->andReturn(true)->getMock()
            ->shouldReceive('count')->andReturn($count)->getMock()
        ;

        if ($count > 0) {
            $request->query->shouldReceive('all')->andReturn($filters);
        }

        return $request;
    }

    protected function createPaginator($limit, $page, $pageParameterName = '_page')
    {
        $pagination = m::mock(SlidingPagination::class, ['p' => 'v']);
        $pagination
            ->shouldReceive('getPaginationData')
            ->once()
            ->andReturn([
                'firstPageInRange' => 1,
                'lastPageInRange' => 5
            ])
            ->getMock()
            ->shouldReceive('setCustomParameters')
        ;

        $paginator = m::mock(Paginator::class);
        $paginator->shouldReceive('paginate')
            ->with(anything(), $page, $limit, ['pageParameterName' => $pageParameterName])
            ->once()
            ->andReturn($pagination)
        ;

        return $paginator;
    }

    protected function setUpProcessForm($request, $method, $typeClassName)
    {
        $form = m::mock()
            ->shouldReceive('handleRequest')->with($request)->getMock()
            ->shouldReceive('isValid')->andReturn(true)->getMock()
        ;

        $this->em
            ->shouldReceive('persist')->with(anInstanceOf($this->className))->getMock()
            ->shouldReceive('flush')
        ;

        $this->formFactory
            ->shouldReceive('create')->with(
                anInstanceOf($typeClassName), anInstanceOf($this->className), ['method' => $method]
            )->andReturn($form)->getMock()
        ;
    }
}