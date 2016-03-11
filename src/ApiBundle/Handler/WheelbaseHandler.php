<?php
/**
 * Wheelbase Handler for Wheelbase operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category handler
 * @since 2015.05.29
 */

namespace ApiBundle\Handler;


use IMS\CommonBundle\Entity\Wheelbase;
use ApiBundle\Form\WheelbaseType;
use ApiBundle\Request\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class WheelbaseHandler extends AbstractHandler implements ApiHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getList(Request $request)
    {
        return $this->handleList(
            $this->repository->createQueryBuilder('wheelbase'),
            new Query($request->query)
        );
    }

    /**
     * @param integer $id
     * @return object
     */
    public function getOneById($id)
    {
        $entity = $this->repository->find($id);

        if (!$entity instanceof Wheelbase) {
            throw new NotFoundHttpException('Wheelbase not found');
        }

        return $entity;
    }

    /**
     * @param string $field
     * @param string $value
     * @return Wheelbase
     */
    public function getOneBy($field, $value)
    {
        $entity = $this->repository->findOneBy([$field => $value]);

        if (!$entity instanceof Wheelbase) {
            throw new NotFoundHttpException('Wheelbase not found');
        }

        return $entity;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        return $this->processForm(new Wheelbase(), new WheelbaseType(), $request, 'POST');
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request)
    {
        $entity = $this->getOneById($id);

        return $this->processForm($entity, new WheelbaseType(), $request, $request->getMethod());
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return HandlerResponse
     */
    public function put($id, Request $request)
    {
        $handlerResponse = new HandlerResponse();
        $handlerResponse->updating();

        $entity = $this->repository->find($id);

        if ($entity === null) {
            $entity = new Wheelbase();
            $handlerResponse->creating();
        }

        $handlerResponse->entity = $this->processForm($entity, new WheelbaseType(), $request, 'PUT');

        return $handlerResponse;
    }

    /**
     * @param integer $id
     * @return void
     */
    public function delete($id)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));

    }
}