<?php
/**
 * Currency Controller for Currency operations
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
 * Currency controller.
 *
 */
class CurrencyController extends RestController
{

    /**
     * Lists all Currency entities.
     *
     * @ApiDoc(
     *      resource=true,
     *      description="GET a list of Currency",
     *      section="Currency",
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
        $handler = $this->get('api.currency_handler');

        return $this->view(
            $handler->getList($request),
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single Currency for the supplied ID.
     *
    * @ApiDoc(
    *      resource=true,
    *      description="GET a single Currency by ID",
    *      section="Currency",
    *      requirements={
    *          {"name"="id", "dataType"="integer", "required"=true, "description"="ID of Currency"}
    *      },
    *      statusCodes={
    *          200="Returned when successful",
    *          404="Returned when the Currency is not found"
    *      }
    * )
     */
    public function getOneByIdAction($id)
    {
        $handler = $this->get('api.currency_handler');
        $entity = $handler->getOneById($id);

        return $this->view(
            $entity,
            Codes::HTTP_OK
        );
    }

    /**
     * Returns a single Currency for the supplied ISO.
     *
    * @ApiDoc(
    *      resource=true,
    *      description="GET a single Currency by ISO",
    *      section="Currency",
    *      requirements={
    *          {"name"="iso", "dataType"="string", "required"=true, "description"="ISO of Currency"}
    *      },
    *      statusCodes={
    *          200="Returned when successful",
    *          404="Returned when the Currency is not found"
    *      }
    * )
     */
    public function getOneByIsoAction($iso)
    {
        $handler = $this->get('api.currency_handler');
        $entity = $handler->getOneBy('isoCode', $iso);

        return $this->view(
            $entity,
            Codes::HTTP_OK
        );
    }


}
