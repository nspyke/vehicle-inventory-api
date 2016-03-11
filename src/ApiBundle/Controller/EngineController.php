<?php
/**
 * Engine Controller for Engine operations
 *
 * @author Nik Spijkerman <nikolas.spijkerman@gmail.com>
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
 * Engine controller.
 *
 */
class EngineController extends RestController
{

    /**
     * Lists all Engine entities.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of Engine",
     *      section="Engine",
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
        $handler = $this->get('api.engine_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a list of Engine manufacturer codes, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of Engine manufacturer codes",
     *      section="Engine",
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
        $handler = $this->get('api.engine_manufacturer_code_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single Engine for the supplied ID.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single Engine by ID",
     *      section="Engine",
     *      requirements={
     *          {"name"="id", "dataType"="integer", "required"=true, "description"="ID of Engine"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the Engine is not found"
     *      }
     * )
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.engine_handler');
        $entity = $handler->getOneById($id);

        return $this->view(
            $entity,
            Codes::HTTP_OK
        );
    }

    /**
     * Creates a new Engine entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Engine",
     *      description="Create an Engine",
     *      input="ApiBundle\Form\EngineType",
     *      statusCodes={
     *          201="Engine created successfully",
     *          400="Bad request. Validation error"
     *      }
     * )
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        try {
            $handler = $this->get('api.engine_handler');
            $entity = $handler->post($request);

            return $this->routeRedirectView('engines_id', ['id' => $entity->getId()]);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }

    }


    /**
     * Updates an existing IMS\CommonBundle\Entity\Engine entity.
     *
     * NOTE: When performing an update, it is a full update.
     * This means that only the fields supplied in the JSON body will be set.
     * All other fields will be reset/set to NULL.
     * If you want to do a partial update, use the PATCH endpoint below.
     *
     * @ApiDoc(
     *      resource=true,
     *      section="Engine",
     *      description="Update a Engine or create it if it doesn't exist",
     *      resourceDescription="Operations on Engine.",
     *      input="ApiBundle\Form\EngineType",
     *      statusCodes={
     *          201="Engine created successfully.",
     *          204="Engine updated successfully.",
     *          400="Bad request. Validation error.",
     *          404="Engine not found."
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function putAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.engine_handler');

            /** @var \ApiBundle\Handler\HandlerResponse $response */
            $response = $handler->put($id, $request);

            $statusCode = $response->isCreate() ? Codes::HTTP_CREATED : Codes::HTTP_NO_CONTENT;

            return $this->routeRedirectView('engines_id', ['id' => $response->entity->getId()], $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Updates an existing IMS\CommonBundle\Entity\Engine entity.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Engine",
     *      description="Update an Engine",
     *      input="ApiBundle\Form\EngineType",
     *      statusCodes={
     *          204="Engine updated successfully",
     *          400="Bad request. Validation error",
     *          404="Engine not found. ID is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function patchAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.engine_handler');
            $entity = $handler->patch($id, $request);

            return $this->routeRedirectView('engines_id', ['id' => $entity->getId()], Codes::HTTP_NO_CONTENT);
        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
}
