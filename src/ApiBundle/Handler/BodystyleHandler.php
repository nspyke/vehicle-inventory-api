<?php


namespace ApiBundle\Handler;


use ApiBundle\Request\Query;
use IMS\CommonBundle\Entity\Bodystyle;
use ApiBundle\Form\BodystyleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BodystyleHandler extends AbstractHandler implements ApiHandlerInterface
{
     /**
     * {@inheritdoc}
     */
    public function getList(Request $request)
    {
        return $this->handleList(
            $this->repository->getQueryBuilder('b'),
            new Query($request->query)
        );
    }

    /**
     * @param integer $id
     * @return object
     */
    public function getOneById($id)
    {
        $bodystyle = $this->repository->findByQuery($id)->getOneOrNullResult();

        if (!$bodystyle instanceof Bodystyle) {
            throw new NotFoundHttpException('Bodystyle not found');
        }

        return $bodystyle;
    }

    /**
     * @param string $field
     * @param string $value
     * @return Bodystyle
     */
    public function getOneBy($field, $value)
    {
        $entity = $this->repository->findByQuery($value, $field)->getOneOrNullResult();

        if (!$entity instanceof Bodystyle) {
            throw new NotFoundHttpException('Bodystyle not found');
        }

        return $entity;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {
        return $this->processForm(new Bodystyle(), new BodystyleType(), $request, 'POST');
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request)
    {
        $entity = $this->getOneById($id);

        return $this->processForm($entity, new BodystyleType(), $request, $request->getMethod());
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return HandlerResponse
     */
    public function put($id, Request $request)
    {
        // Using a HandlerResponse container so that when the result arrives
        // back in the controller, we know what status code to send
        $handlerResponse = new HandlerResponse();
        $handlerResponse->updating();
           
        $entity = $this->repository->findByQuery($id)->getOneOrNullResult();
                
        if ($entity === null) {
            $entity = new Bodystyle();
            $handlerResponse->creating();
        }

        $handlerResponse->entity = $this->processForm($entity, new BodystyleType(), $request, 'PUT');

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