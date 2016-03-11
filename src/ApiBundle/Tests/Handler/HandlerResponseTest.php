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


use ApiBundle\Handler\HandlerResponse;

class HandlerResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testCreating()
    {
        $r = new HandlerResponse();
        $r->creating();

        $this->assertTrue($r->isCreate());
    }

    public function testUpdating()
    {
        $r = new HandlerResponse();
        $r->updating();

        $this->assertTrue($r->isUpdate());
    }

    public function testReading()
    {
        $r = new HandlerResponse();
        $r->reading();

        $this->assertTrue($r->isRead());
    }

}
