<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Configsite extends DataLayer
{
    public function __construct()
    {
        parent::__construct('config_site', [], 'id', false);
    }
}
