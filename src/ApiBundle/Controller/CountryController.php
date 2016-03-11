<?php
/**
 * Country Controller for Country operations
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

use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\FOSRestController;

/**
 * Country controller.
 *
 */
class CountryController extends RestController
{

    /**
     * Lists all Country entities.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of Country",
     *      section="Country",
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
        $handler = $this->get('api.country_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single Country for the supplied ID.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single Country by ID",
     *      section="Country",
     *      requirements={
     *          {"name"="id", "dataType"="integer", "required"=true, "description"="ID of Country"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the Country is not found"
     *      }
     * )
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.country_handler');
        $entity = $handler->getOneById($id);

        return $this->view(
            $entity,
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single Country for the supplied ISO Code.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a single Country by ID",
     *      section="Country",
     *      requirements={
     *          {"name"="iso", "dataType"="string", "required"=true, "description"="ID of Country"}
     *      },
     *      statusCodes={
     *          200="Returned when successful",
     *          404="Returned when the Country is not found"
     *      }
     * )
     */
    public function getOneByIsoAction($iso)
    {
        $handler = $this->get('api.country_handler');
        $entity = $handler->getOneBy('isoCode', $iso);

        return $this->view(
            $entity,
            Codes::HTTP_OK
        );
    }


}
