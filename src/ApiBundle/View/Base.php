<?php
/**
 * Base View Model for API
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category view
 * @since 2015.05.14
 */

namespace ApiBundle\View;


class Base 
{
    const API_VERSION = "1.0.0";

    /**
     * @var string
     */
    public $apiVersion = self::API_VERSION;

    /**
     * @var Data
     */
    public $data;

    /**
     * @var Error
     */
    public $error;
}