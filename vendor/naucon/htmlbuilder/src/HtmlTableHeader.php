<?php
/*
 * Copyright 2008 Sven Sanzenbacher
 *
 * This file is part of the naucon package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Naucon\HtmlBuilder;

/**
 * Html Table Header Class
 *
 * @package    HtmlBuilder
 * @author     Sven Sanzenbacher
 */
class HtmlTableHeader extends HtmlTableCellAbstract
{
    /**
     * @access      protected
     * @var         string                      html element tag
     */
    protected $tag = 'th';

    /**
     * Constructor
     *
     * @param       string      $content        table header content
     */
    public function __construct($content)
    {
        $this->setContent($content);
    }
}