<?php
/**
 * 
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package 
 * @category 
 * @since 2015.05.19
 */

namespace ApiBundle\Handler;


use ApiBundle\View\Factory\ViewFactory;
use FOS\RestBundle\Util\ExceptionWrapper;
use FOS\RestBundle\View\ExceptionWrapperHandlerInterface;

class ExceptionWrapperHandler implements ExceptionWrapperHandlerInterface
{
    /**
     * @var ViewFactory
     */
    protected $viewFactory;

    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function wrap($data)
    {
        return $this->viewFactory->createErrorView(new ExceptionWrapper($data));
    }
}