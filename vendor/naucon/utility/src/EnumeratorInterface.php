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
 * Enumerator Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface EnumeratorInterface extends IteratorInterface
{
    /**
     * get value
     *
     * @param    mixed      $key        key
     * @return   mixed                  value
     */
    public function __get($key);

    /**
     * set key value pair
     *
     * @param    mixed      $key        key
     * @param    mixed      $value      value
     * @return   void
     */
    public function __set($key, $value);

    /**
     * add or replace a value with a specified key
     *
     * @param    mixed      $key        key
     * @param    mixed      $value      value
     * @return   mixed                  value
     */
    public function set($key, $value);

    /**
     * @param    mixed      $key        key
     * @return   bool
     */
    public function remove($key);
}