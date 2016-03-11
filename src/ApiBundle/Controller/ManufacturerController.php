<?php
/**
 * Manufacturers Controller for manufacturers operations
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category controller
 * @since 2015.05.06
 */

namespace ApiBundle\Controller;

use IMS\CommonBundle\Entity\Manufacturers;
use AppBundle\Exception\InvalidFormException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class ManufacturerController extends RestController
{
    /**
     * Returns a list of manufacturers, optionally filtered.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of manufacturers",
     *      section="Manufacturers",
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
        $handler = $this->get('api.manufacturer_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single manufacturer for the supplied ID
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single manufacturer by ID",
     *      section="Manufacturers",
     *      requirements={
     *          {"name"="id", "dataType"="integer", "required"=true, "description"="ID of manufacturers"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the manufacturers is not found"
     *      }
     * )
     * @View(serializerEnableMaxDepthChecks=true)
     * @param integer $id
     * @return \FOS\RestBundle\View\View
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.manufacturer_handler');
        $manufacturers = $handler->getOneById($id);

        return $this->view(
            $manufacturers,
            Codes::HTTP_OK
        );
    }   

    /**
     * @ApiDoc(
     *      resource = true,
     *      section="Manufacturers",
     *      description="Create a manufacturer",
     *      input="ApiBundle\Form\ManufacturerType",
     *      statusCodes={
     *          201="Manufacturer created successfully",
     *          400="Bad request. Validation error"
     *      }
     * )
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function postAction(Request $request)
    {
        try {
            $handler = $this->get('api.manufacturer_handler');                        
            $entity = $handler->post($request);
                                    
            return $this->routeRedirectView('manufacturers_id', ['id' => $entity->getId()]);

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
     *      section="Manufacturers",
     *      description="Update a manufacturer or create it if it doesn't exist",
     *      input="ApiBundle\Form\ManufacturerType",
     *      statusCodes={
     *          201="Manufacturer created successfully",
     *          204="Manufacturer updated successfully",
     *          400="Bad request. Validation error",
     *          404="Manufacturer not found. ID is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function putAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.manufacturer_handler');

            /** @var \ApiBundle\Handler\HandlerResponse $response */
            $response = $handler->put($id, $request);

            $statusCode = $response->isCreate() ? Codes::HTTP_CREATED : Codes::HTTP_NO_CONTENT;

            return $this->routeRedirectView('manufacturers_id', ['id' => $response->entity->getId()], $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Updates a manufacturer and only changes the fields supplied in the JSON.
     * All other fields will be left untouched.
     *
     * @ApiDoc(
     *      resource = true,
     *      section="Manufacturers",
     *      description="Update a manufacturer",
     *      input="ApiBundle\Form\ManufacturerType",
     *      statusCodes={
     *          204="Manufacturer updated successfully",
     *          400="Bad request. Validation error",
     *          404="Manufacturer not found. ID is missing"
     *      }
     * )
     * @param integer $id
     * @param Request $request
     * @return \FOS\RestBundle\View\View
     */
    public function patchAction($id, Request $request)
    {
        try {
            $handler = $this->get('api.manufacturer_handler');
            $entity = $handler->patch($id, $request);

            return $this->routeRedirectView('manufacturers_id', ['id' => $entity->getId()], Codes::HTTP_NO_CONTENT);
        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }
}
