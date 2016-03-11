<?php
/**
 * Base controller for API controller
 * Overrides the FOSRestController view method to create view model
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category controller
 * @since 2015.05.15
 */

namespace ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use Knp\Component\Pager\Pagination\AbstractPagination;
use IMS\CommonBundle\Entity\EntityInterface;

abstract class RestController extends FOSRestController
{
    /**
     * @param mixed $data
     * @param int $statusCode
     * @param array $headers
     * @param array $routeParams
     * @return \FOS\RestBundle\View\View
     */
    protected function view($data = null, $statusCode = null, array $headers = array(), array $routeParams = array())
    {
        $factory = $this->container->get('api.view_factory');

        if ($data instanceof AbstractPagination) {
            $data = $factory->createPaginatedView($data, $routeParams);
        } elseif ($data instanceof EntityInterface) {
            $data = $factory->createSingleView($data);
        } else {
            $data = $factory->createView($data);
        }

        return parent::view($data, $statusCode, $headers);
    }


}