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

use ApiBundle\View\Base;
use Mockery as m;
use ApiBundle\View\Factory\ViewFactory;
use ApiBundle\Handler\ExceptionWrapperHandler;
use FOS\RestBundle\Util\ExceptionWrapper;

class ExceptionWrapperHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testWrap()
    {
        $data = [
            'status_code' => 500,
            'message' => 'message'
        ];

        $viewFactory = m::mock(ViewFactory::class)
            ->shouldReceive('createErrorView')
            ->with(anInstanceOf(ExceptionWrapper::class))
            ->once()
            ->andReturn(m::mock(Base::class))
            ->getMock();


        $w = new ExceptionWrapperHandler($viewFactory);
        $r = $w->wrap($data);

        $this->assertInstanceOf(Base::class, $r);
    }
}
