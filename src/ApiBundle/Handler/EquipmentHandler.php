<?php
/**
 * Equipment Handler for equipment operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category handler
 * @since 2015.05.06
 */

namespace ApiBundle\Handler;


use ApiBundle\Request\Query;
use IMS\CommonBundle\Entity\Equipment;
use ApiBundle\Form\EquipmentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EquipmentHandler extends AbstractHandler implements ApiHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    public function getList(Request $request)
    {
        return $this->handleList(
            $this->repository->getQueryBuilder('e'),
            new Query($request->query)
        );
    }

    /**
     * @param integer $id
     * @return object
     */
    public function getOneById($id)
    {
        $equipment = $this->repository->findByQuery($id)->getOneOrNullResult();

        if (!$equipment instanceof Equipment) {
            throw new NotFoundHttpException('Equipment not found');
        }

        return $equipment;
    }

    /**
     * @param string $field
     * @param string $value
     * @return Equipment
     */
    public function getOneBy($field, $value)
    {
        $entity = $this->repository->findByQuery($value, $field)->getOneOrNullResult();;

        if (!$entity instanceof Equipment) {
            throw new NotFoundHttpException('Equipment not found');
        }

        return $entity;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request)
    {        
        return $this->processForm(new Equipment(), new EquipmentType(), $request, 'POST');
    }

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request)
    {
        $entity = $this->getOneById($id);

        return $this->processForm($entity, new EquipmentType(), $request, $request->getMethod());
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
            $entity = new Equipment();
            $handlerResponse->creating();
        }

        $handlerResponse->entity = $this->processForm($entity, new EquipmentType(), $request, 'PUT');

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