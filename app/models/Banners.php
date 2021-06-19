<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Banners extends DataLayer
{
    public function __construct()
    {
        parent::__construct('banners', ['description', 'enable'], 'id', false);
    }
}
