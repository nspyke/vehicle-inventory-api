<?php
/**
 * Currency Handler for Currency operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category handler
 * @since 2015.05.29
 */

namespace ApiBundle\Handler;


use IMS\CommonBundle\Entity\Currency;
use ApiBundle\Form\CurrencyType;
use ApiBundle\Request\Query;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CurrencyHandler extends AbstractHandler implements ApiHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getList(Request $request)
    {
        return $this->handleList(
            $this->repository->createQueryBuilder('currency'),
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

        if (!$entity instanceof Currency) {
            throw new NotFoundHttpException('Currency not found');
        }

        return $entity;
    }

    /**
     * @param string $field
     * @param string $value
     * @return Currency
     */
    public function getOneBy($field, $value)
    {
        $entity = $this->repository->findOneBy([$field => $value]);

        if (!$entity instanceof Currency) {
            throw new NotFoundHttpException('Currency not found');
        }

        return $entity;
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
    public function patch($id, Request $request)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));

    }

    /**
     * @param integer $id
     * @param Request $request
     * @return HandlerResponse
     */
    public function put($id, Request $request)
    {
        throw new \BadMethodCallException(sprintf('Method "%s" is not allowed', __METHOD__));

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