<?php
/**
 * Manufacturer Handler for manufacturer operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category handler
 * @since 2015.05.06
 */

namespace ApiBundle\Handler;


use ApiBundle\Request\Query;
use IMS\CommonBundle\Entity\Manufacturer;
use ApiBundle\Form\ManufacturerType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ManufacturerHandler extends AbstractHandler implements ApiHandlerInterface
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
        $manufacturer = $this->repository->findByQuery($id)->getOneOrNullResult();

        if (!$manufacturer instanceof Manufacturer) {
            throw new NotFoundHttpException('Manufacturer not found');
        }

        return $manufacturer;
    }

    /**
     * @param string $field
     * @param string $value
     * @return Manufacturer
     */
    public function getOneBy($field, $value)
    {
        $entity = $this->repository->findByQuery($value, $field)->getOneOrNullResult();

        if (!$entity instanceof Manufacturer) {
            throw new NotFoundHttpException('Manufacturer not found');
        }

        return $entity;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {        
        return $this->processForm(new Manufacturer(), new ManufacturerType(), $request, 'POST');
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request)
    {
        $entity = $this->getOneById($id);

        return $this->processForm($entity, new ManufacturerType(), $request, $request->getMethod());
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
            $entity = new Manufacturer();
            $handlerResponse->creating();
        }

        $handlerResponse->entity = $this->processForm($entity, new ManufacturerType(), $request, 'PUT');

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