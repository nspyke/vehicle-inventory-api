<?php
/**
 * Base class for all manufacturer code entities
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package ims-api
 * @category handler
 * @since 2015.06.01
 */

namespace ApiBundle\Handler;


use ApiBundle\Request\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManufacturerCodeHandler extends AbstractHandler implements ApiHandlerInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getList(Request $request)
    {
        return $this->handleList(
            $this->repository->createQueryBuilder('mc'),
            new Query($request->query)
        );
    }

    /**
     * @param int $id
     * @return mixed#
     */
    public function getOneById($id)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function put($id, Request $request)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function delete($id)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));
    }

}
