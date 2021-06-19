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
 * Delegator Interface
 *
 * @abstract
 * @package    Utility
 * @author     Sven Sanzenbacher
 */
interface DelegatorInterface
{
    /**
     * @abstract
     * @param       DelegateInterface       $delegateObject
     * @return      mixed
     */
    public function register(DelegateInterface $delegateObject);
}