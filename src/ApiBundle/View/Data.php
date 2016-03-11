<?php
/**
 * Data view model for API
 *
 * @author Nik Spijkerman <nikspijkerman@gmail.com>
 * @package api
 * @category view
 * @since 2015.05.14
 */

namespace ApiBundle\View;


class Data
{
    /**
     * @var string
     */
    public $kind;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $lang;

    /**
     * @var \DateTime
     */
    public $updated;

    /**
     * @var \DateTime
     */
    public $deleted;

    /**
     * @var int
     */
    public $currentItemCount;

    /**
     * @var int
     */
    public $itemsPerPage;

    /**
     * @var int
     */
    public $totalItems;

    /**
     * @var int
     */
    public $pageIndex;

    /**
     * @var int
     */
    public $totalPages;

    /**
     * @var string
     */
    public $nextLink;

    /**
     * @var string
     */
    public $previousLink;

    /**
     * @var string
     */
    public $pagingLinkTemplate;

    /**
     * @var array
     */
    public $items;
}