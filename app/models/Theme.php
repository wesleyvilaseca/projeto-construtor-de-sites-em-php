<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Theme extends DataLayer
{
    public function __construct()
    {
        parent::__construct('theme', [], 'id', false);
    }
}
