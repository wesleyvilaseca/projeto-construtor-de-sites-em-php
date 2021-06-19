<?php
/*
 * Copyright 2015 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\Utility;

/**
 * Paginator Class
 * Pagination process of deviding entries into pages
 *
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
class Paginator extends PaginatorAbstract
{
    /**
     * Constructor
     *
     * @param    array      $items              items
     * @param    int        $itemsPerPage       item offset
     */
    public function __construct(array $items = array(), $itemsPerPage = 50)
    {
        $this->_items = $items;

        $this->setItemsPerPage($itemsPerPage);
    }
}