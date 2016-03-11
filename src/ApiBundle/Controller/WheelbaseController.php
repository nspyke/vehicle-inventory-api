<?php
/**
 * Wheelbase Controller for Wheelbase operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category controller
 * @since 2015.05.29
 */

namespace ApiBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations\View;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Wheelbase controller.
 *
 */
class WheelbaseController extends RestController
{

    /**
     * Lists all Wheelbase entities.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of Wheelbase",
     *      section="Wheelbase",
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
        $handler = $this->get('api.wheelbase_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a list of Wheelbase manufacturer codes, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of Wheelbase manufacturer codes",
     *      section="Wheelbase",
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
        $handler = $this->get('api.wheelbase_manufacturer_code_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single Wheelbase for the supplied ID.
     *
    * @ApiDoc(
    *      resource=true,
    *      description="GET a single Wheelbase by ID",
    *      section="Wheelbase",
    *      requirements={
    *          {"name"="id", "dataType"="integer", "required"=true, "description"="ID of Wheelbase"}
    *      },
    *      statusCodes={
    *          200="Returned when successful",
    *          404="Returned when the Wheelbase is not found"
    *      }
    * )
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.wheelbase_handler');
        $entity = $handler->getOneById($id);

        return $this->view(
            $entity,
            Codes::HTTP_OK
        );
    }
    /**
     * Creates a new Wheelbase entity.
     *
    * @ApiDoc(
    *      resource = true,
    *      section="Wheelbase",
    *      description="Create an Wheelbase",
    *      input="ApiBundle\Form\WheelbaseType",
    *      statusCodes={
    *          201="Wheelbase created successfully",
    *          400="Bad request. Validation error"
    *      }
    * )
    * @param Request $request
    * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        try {
            $handler = $this->get('api.wheelbase_handler');
            $entity = $handler->post($request);

            return $this->routeRedirectView('wheelbases_id', ['id' => $entity->getId()]);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }

    }


    /**
    * Updates an existing IMS\CommonBundle\Entity\Wheelbase entity.
    *
    * NOTE: When performing an update, it is a full update.
    * This means that only the fields supplied in the JSON body will be set.
    * All other fields will be reset/set to NULL.
    * If you want to do a partial update, use the PATCH endpoint below.
    *
    * @ApiDoc(
    *      resource=true,
    *      section="Wheelbase",
    *      description="Update a Wheelbase or create it if it doesn't exist",
    *      resourceDescription="Operations on Wheelbase.",
    *      input="ApiBundle\Form\WheelbaseType",
    *      statusCodes={
    *          201="Wheelbase created successfully.",
    *          204="Wheelbase updated successfully.",
    *          400="Bad request. Validation error.",
    *          404="Wheelbase not found."
    *      }
    * )
    * @param integer $id
    * @param Request $request
    * @return \FOS\RestBundle\View\View
    */
    public function putAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.wheelbase_handler');

            /** @var \ApiBundle\Handler\HandlerResponse $response */
            $response = $handler->put($id, $request);

            $statusCode = $response->isCreate() ? Codes::HTTP_CREATED : Codes::HTTP_NO_CONTENT;

            return $this->routeRedirectView('wheelbases_id', ['id' => $response->entity->getId()], $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
    /**
     * Updates an existing IMS\CommonBundle\Entity\Wheelbase entity.
     *
    * @ApiDoc(
    *      resource = true,
    *      section="Wheelbase",
    *      description="Update an Wheelbase",
    *      input="ApiBundle\Form\WheelbaseType",
    *      statusCodes={
    *          204="Wheelbase updated successfully",
    *          400="Bad request. Validation error",
    *          404="Wheelbase not found. ID is missing"
    *      }
    * )
    * @param integer $id
    * @param Request $request
    * @return \FOS\RestBundle\View\View
     */
    public function patchAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.wheelbase_handler');
            $entity = $handler->patch($id, $request);

            return $this->routeRedirectView('wheelbases_id', ['id' => $entity->getId()], Codes::HTTP_NO_CONTENT);
        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
}
