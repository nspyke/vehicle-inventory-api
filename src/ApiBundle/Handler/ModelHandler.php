<?php


namespace ApiBundle\Handler;


use ApiBundle\Request\Query;
use IMS\CommonBundle\Entity\Model;
use ApiBundle\Form\ModelType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ModelHandler extends AbstractHandler implements ApiHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getList(Request $request)
    {
        return $this->handleList(
            $this->repository->getQueryBuilder('m'),
            new Query($request->query)
        );
    }

    /**
     * @param integer $id
     * @return object
     */
    public function getOneById($id)
    {
        $model = $this->repository->findByQuery($id)->getOneOrNullResult();

        if (!$model instanceof Model) {
            throw new NotFoundHttpException('Model not found');
        }

        return $model;
    }

    /**
     * @param string $field
     * @param string $value
     * @return Model
     */
    public function getOneBy($field, $value)
    {
        $entity = $this->repository->findByQuery($value, $field)->getOneOrNullResult();

        if (!$entity instanceof Model) {
            throw new NotFoundHttpException('Model not found');
        }

        return $entity;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        return $this->processForm(new Model(), new ModelType(), $request, 'POST');
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request)
    {
        $entity = $this->getOneById($id);

        return $this->processForm($entity, new ModelType(), $request, $request->getMethod());
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
            $entity = new Model();
            $handlerResponse->creating();
        }

        $handlerResponse->entity = $this->processForm($entity, new ModelType(), $request, 'PUT');

        return $handlerResponse;
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function delete($id)
    {
        throw new \BadMethodCallException(sprintf('The method "%s" has not been implemented on "%s".', __METHOD__, __CLASS__));
    }
}