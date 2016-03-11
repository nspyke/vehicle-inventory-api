<?php

namespace ApiBundle\Controller;

use IMS\CommonBundle\Entity\Vehicle;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class VehicleController extends RestController
{
    /**
     * Returns a list of vehicles, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of vehicles",
     *      resourceDescription="Operations on vehicles.",
     *      section="Vehicles",
     *      filters={
     *          {"name"="_limit", "dataType"="integer", "default"=10},
     *          {"name"="_page", "dataType"="integer", "default"=1},
     *          {"name"="_sort", "dataType"="string"},
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function getListAction(Request $request)
    {
        $handler = $this->get('api.vehicle_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single vehicle for the supplied ID
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single vehicle by ID",
     *      resourceDescription="Operations on vehicles.",
     *      section="Vehicles",
     *      requirements={
     *          {"name"="id", "dataType"="integer", "requirement"="\d+", "required"=true, "description"="ID of vehicle"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the vehicle is not found"
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.vehicle_handler');
        $vehicle = $handler->getOneById($id);

        return $this->view(
            $vehicle,
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single vehicle for the supplied VIN
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single vehicle by VIN",
     *      resourceDescription="Operations on vehicles.",
     *      section="Vehicles",
     *      requirements={
     *          {"name"="vin", "dataType"="string", "required"=true, "description"="VIN of vehicle"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the vehicle is not found"
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param string $vin
     * @return \FOS\RestBundle\View\View
     */
    public function getOneByVinAction($vin)
    {
        $handler = $this->get('api.vehicle_handler');
        $vehicle = $handler->getOneBy('vin', $vin);

        return $this->view(
            $vehicle,
            Codes::HTTP_OK
        );
    }


    /**
     * @ApiDoc(
     *      resource = true,
     *      section="Vehicles",
     *      description="Create a vehicle",
     *      resourceDescription="Operations on vehicles.",
     *      input="ApiBundle\Form\VehicleType",
     *      parameters={
     *          {"name"="vehicle[transmission]", "dataType"="integer"}
     *      },
     *      statusCodes={
     *          201="Vehicle created successfully",
     *          400="Bad request. Validation error"
     *      }
     * )
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        try {
            $handler = $this->get('api.vehicle_handler');
            $entity = $handler->post($request);

            return $this->routeRedirectView('vehicles_id', ['id' => $entity->getId()]);

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
     *      section="Vehicles",
     *      description="Update a vehicle or create it if it doesn't exist",
     *      resourceDescription="Operations on vehicles.",
     *      input="ApiBundle\Form\VehicleType",
     *      statusCodes={
     *          201="Vehicle created successfully",
     *          204="Vehicle updated successfully",
     *          400="Bad request. Validation error",
     *          404="Vehicle not found. ID and/or VIN is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function putAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.vehicle_handler');

            /** @var \ApiBundle\Handler\HandlerResponse $response */
            $response = $handler->put($id, $request);

            $statusCode = $response->isCreate() ? Codes::HTTP_CREATED : Codes::HTTP_NO_CONTENT;

            return $this->routeRedirectView('vehicles_id', ['id' => $response->entity->getId()], $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Updates a vehicle and only changes the fields supplied in the JSON.
     * All other fields will be left untouched.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Vehicles",
     *      description="Update a vehicle",
     *      resourceDescription="Operations on vehicles.",
     *      input="ApiBundle\Form\VehicleType",
     *      statusCodes={
     *          204="Vehicle updated successfully",
     *          400="Bad request. Validation error",
     *          404="Vehicle not found. ID and/or VIN is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function patchAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.vehicle_handler');
            $entity = $handler->patch($id, $request);

            return $this->routeRedirectView('vehicles_id', ['id' => $entity->getId()], Codes::HTTP_NO_CONTENT);
        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
}
