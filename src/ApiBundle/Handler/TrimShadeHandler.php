<?php
/**
 * TrimShade Handler for TrimShade operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category handler
 * @since 2015.05.29
 */

namespace ApiBundle\Handler;


use IMS\CommonBundle\Entity\TrimShade;
use ApiBundle\Form\TrimShadeType;
use ApiBundle\Request\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TrimShadeHandler extends AbstractHandler implements ApiHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getList(Request $request)
    {
        return $this->handleList(
            $this->repository->getQueryBuilder('trimshade'),
            new Query($request->query)
        );
    }

    /**
     * @param integer $id
     * @return object
     */
    public function getOneById($id)
    {
        $entity = $this->repository->findByQuery($id)->getOneOrNullResult();

        if (!$entity instanceof TrimShade) {
            throw new NotFoundHttpException('TrimShade not found');
        }

        return $entity;
    }

    /**
     * @param string $field
     * @param string $value
     * @return TrimShade
     */
    public function getOneBy($field, $value)
    {
        $entity = $this->repository->findByQuery($value, $field)->getOneOrNullResult();

        if (!$entity instanceof TrimShade) {
            throw new NotFoundHttpException('TrimShade not found');
        }

        return $entity;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        return $this->processForm(new TrimShade(), new TrimShadeType(), $request, 'POST');
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request)
    {
        $entity = $this->getOneById($id);

        return $this->processForm($entity, new TrimShadeType(), $request, $request->getMethod());
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

        $entity = $this->repository->findByQuery($id)->getOneOrNullResult();

        if ($entity === null) {
            $entity = new TrimShade();
            $handlerResponse->creating();
        }

        $handlerResponse->entity = $this->processForm($entity, new TrimShadeType(), $request, 'PUT');

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