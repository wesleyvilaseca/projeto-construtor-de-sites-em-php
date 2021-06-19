<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Modules extends DataLayer
{
    public function __construct()
    {
        parent::__construct('modules', ['description', 'module_code', 'module_route', 'enable'], 'id', false);
    }
}
