<?php

namespace ApiBundle\Controller;

use IMS\CommonBundle\Entity\Model;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class ModelController extends RestController
{
    /**
     * Returns a list of models, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of models",
     *      section="Models",
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
        $handler = $this->get('api.model_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single model for the supplied ID
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single model by ID",
     *      section="Models",
     *      requirements={
     *          {"name"="id", "dataType"="integer", "requirement"="\d+", "required"=true, "description"="ID of model"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the model is not found"
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.model_handler');
        $model = $handler->getOneById($id);

        return $this->view(
            $model,
            Codes::HTTP_OK
        );
    }

    /**
     * @ApiDoc(
     *      resource = true,
     *      section="Models",
     *      description="Create a model",
     *      input="ApiBundle\Form\ModelType",
     *      parameters={
     *          {"name"="series", "dataType"="integer"}
     *      },
     *      statusCodes={
     *          201="Model created successfully",
     *          400="Bad request. Validation error"
     *      }
     * )
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        try {
            $handler = $this->get('api.model_handler');
            $entity = $handler->post($request);

            return $this->routeRedirectView('models_id', ['id' => $entity->getId()]);

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
     *      section="Models",
     *      description="Update a model or create it if it doesn't exist",
     *      input="ApiBundle\Form\ModelType",
     *      statusCodes={
     *          201="Model created successfully",
     *          204="Model updated successfully",
     *          400="Bad request. Validation error",
     *          404="Model not found. ID is missing"
     *      }
     * )
     * @param int $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function putAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.model_handler');

            /** @var \ApiBundle\Handler\HandlerResponse $response */
            $response = $handler->put($id, $request);

            $statusCode = $response->isCreate() ? Codes::HTTP_CREATED : Codes::HTTP_NO_CONTENT;

            return $this->routeRedirectView('models_id', ['id' => $response->entity->getId()], $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Updates a model and only changes the fields supplied in the JSON.
     * All other fields will be left untouched.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Models",
     *      description="Update a model",
     *      input="ApiBundle\Form\ModelType",
     *      statusCodes={
     *          204="Model updated successfully",
     *          400="Bad request. Validation error",
     *          404="Model not found. ID  missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function patchAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.model_handler');
            $entity = $handler->patch($id, $request);

            return $this->routeRedirectView('models_id', ['id' => $entity->getId()], Codes::HTTP_NO_CONTENT);
        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
}
