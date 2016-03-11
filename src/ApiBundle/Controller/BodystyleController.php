<?php

namespace ApiBundle\Controller;

use IMS\CommonBundle\Entity\Bodystyle;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class BodystyleController extends RestController
{
    /**
     * Returns a list of bodystyles, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of bodystyles",
     *      section="Bodystyle",
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
        $handler = $this->get('api.bodystyle_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single Bodystyle for the supplied ID
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single Bodystyle by ID",
     *      section="Bodystyle",
     *      requirements={
     *          {"name"="id", "dataType"="string", "required"=true, "description"="ID of vehicle"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the bodystyle is not found"
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param string $id
     * @return \FOS\RestBundle\View\View
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.bodystyle_handler');
        $bodystyle = $handler->getOneBy('id', $id);

        return $this->view(
            $bodystyle,
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a list of bodystyle manufacturer codes, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of bodystyle manufacturer codes",
     *      section="Bodystyle",
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
        $handler = $this->get('api.bodystyle_manufacturer_code_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Updates an bodystyle and only changes the fields supplied in the JSON.
     * All other fields will be left untouched.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Bodystyle",
     *      description="Update an bodystyle",
     *      input="ApiBundle\Form\BodystyleType",
     *      statusCodes={
     *          204="Bodystyle updated successfully",
     *          400="Bad request. Validation error",
     *          404="Bodystyle not found. ID is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function patchAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.bodystyle_handler');
            $entity = $handler->patch($id, $request);

            return $this->routeRedirectView('bodystyle_id', ['id' => $entity->getId()], Codes::HTTP_NO_CONTENT);
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
     *      section="Bodystyle",
     *      description="Update an bodystyle or create it if it doesn't exist",
     *      input="ApiBundle\Form\BodystyleType",
     *      statusCodes={
     *          201="Bodystyle created successfully",
     *          204="Bodystyle updated successfully",
     *          400="Bad request. Validation error",
     *          404="Bodystyle not found. ID is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function putAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.bodystyle_handler');

            /** @var \ApiBundle\Handler\HandlerResponse $response */
            $response = $handler->put($id, $request);

            $statusCode = $response->isCreate() ? Codes::HTTP_CREATED : Codes::HTTP_NO_CONTENT;

            return $this->routeRedirectView('bodystyle_id', ['id' => $response->entity->getId()], $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
    
    /**
     * @ApiDoc(
     *      resource = true,
     *      section="Bodystyle",
     *      description="Create an bodystyle",
     *      input="ApiBundle\Form\BodystyleType",
     *      statusCodes={
     *          201="Bodystyle created successfully",
     *          400="Bad request. Validation error"
     *      }
     * )
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        try {
            $handler = $this->get('api.bodystyle_handler');                        
            $entity = $handler->post($request);
                                    
            return $this->routeRedirectView('bodystyle_id', ['id' => $entity->getId()]);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

}
