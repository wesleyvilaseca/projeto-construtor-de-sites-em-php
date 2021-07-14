<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Blogconfig extends DataLayer
{
    public function __construct()
    {
        parent::__construct('blog_config', ['departament_desc', 'enable'], 'id', false);
    }
}
