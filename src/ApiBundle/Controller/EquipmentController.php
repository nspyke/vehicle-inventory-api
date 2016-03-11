<?php
/**
 * Equipment Controller for equipment operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category controller
 * @since 2015.05.06
 */

namespace ApiBundle\Controller;

use IMS\CommonBundle\Entity\Equipment;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class EquipmentController extends RestController
{
    /**
     * Returns a list of equipments, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of equipments",
     *      section="Equipment",
     *      filters={
     *          {"name"="_sort", "dataType"="string"},
     *          {"name"="_limit", "dataType"="integer", "default"=10},
     *          {"name"="_page", "dataType"="integer", "default"=1},
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function getListAction(Request $request)
    {
        $handler = $this->get('api.equipment_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a list of Equipment manufacturer codes, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of Equipment manufacturer codes",
     *      section="Equipment",
     *      filters={
     *          {"name"="_sort", "dataType"="string"},
     *          {"name"="_limit", "dataType"="integer", "default"=10},
     *          {"name"="_page", "dataType"="integer", "default"=1},
     *      }
     * )
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function getManufacturerCodesListAction(Request $request)
    {
        $handler = $this->get('api.equipment_manufacturer_code_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single equipment for the supplied ID
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single equipment by ID",
     *      section="Equipment",
     *      requirements={
     *          {"name"="id", "dataType"="integer", "required"=true, "description"="ID of equipment"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the equipment is not found"
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param integer $id
     * @return \FOS\RestBundle\View\View
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.equipment_handler');
        $equipment = $handler->getOneById($id);

        return $this->view(
            $equipment,
            Codes::HTTP_OK
        );
    }   

    /**
     * @ApiDoc(
     *      resource = true,
     *      section="Equipment",
     *      description="Create an equipment",
     *      input="ApiBundle\Form\EquipmentType",
     *      statusCodes={
     *          201="Equipment created successfully",
     *          400="Bad request. Validation error"
     *      }
     * )
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        try {
            $handler = $this->get('api.equipment_handler');                        
            $entity = $handler->post($request);
                                    
            return $this->routeRedirectView('equipment_id', ['id' => $entity->getId()]);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
    
    
    /**
     * NOTE: When performing an update, it is a full update.
     * This means that only the fields supplied in the JSON body will be set.
     * All other fields will be reset/set to NULL.
     * If you want to do a partial update, use the PATCH endpoint below.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Equipment",
     *      description="Update an equipment or create it if it doesn't exist",
     *      input="ApiBundle\Form\EquipmentType",
     *      statusCodes={
     *          201="Equipment created successfully",
     *          204="Equipment updated successfully",
     *          400="Bad request. Validation error",
     *          404="Equipment not found. ID is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function putAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.equipment_handler');

            /** @var \ApiBundle\Handler\HandlerResponse $response */
            $response = $handler->put($id, $request);

            $statusCode = $response->isCreate() ? Codes::HTTP_CREATED : Codes::HTTP_NO_CONTENT;

            return $this->routeRedirectView('equipment_id', ['id' => $response->entity->getId()], $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Updates an equipment and only changes the fields supplied in the JSON.
     * All other fields will be left untouched.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Equipment",
     *      description="Update an equipment",
     *      input="ApiBundle\Form\EquipmentType",
     *      statusCodes={
     *          204="Equipment updated successfully",
     *          400="Bad request. Validation error",
     *          404="Equipment not found. ID is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function patchAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.equipment_handler');
            $entity = $handler->patch($id, $request);

            return $this->routeRedirectView('equipment_id', ['id' => $entity->getId()], Codes::HTTP_NO_CONTENT);
        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
}
