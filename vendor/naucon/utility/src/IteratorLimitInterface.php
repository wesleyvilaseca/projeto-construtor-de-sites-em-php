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
 * Iterator Limit Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface IteratorLimitInterface extends IteratorInterface
{
    /**
     * @return    int                   item offset
     */
    public function getItemOffset();

    /**
     * @param     int       $offset     item offset
     * @return    void
     */
    public function setItemOffset($offset);

    /**
     * @return    int                   item count
     */
    public function getItemCount();

    /**
     * @param    int        $count      item count
     * @return   void
     */
    public function setItemCount($count);
}