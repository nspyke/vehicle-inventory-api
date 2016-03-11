<?php
namespace ApiBundle\Handler;

use Symfony\Component\HttpFoundation\Request;

interface ApiHandlerInterface
{
    /**
     * @param Request $request
     * @return array
     */
    public function getList(Request $request);

    /**
     * @param integer $id
     * @return object
     */
    public function getOneById($id);

    /**
     * @param Request $request
     * @return mixed
     */
    public function post(Request $request);

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function put($id, Request $request);

    /**
     * @param integer $id
     * @param Request $request
     * @return mixed
     */
    public function patch($id, Request $request);

    /**
     * @param integer $id
     * @return mixed
     */
    public function delete($id);
}