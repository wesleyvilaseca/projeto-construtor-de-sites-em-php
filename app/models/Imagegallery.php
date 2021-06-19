<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Imagegallery extends DataLayer
{
    public function __construct()
    {
        parent::__construct('image_gallery', ['banner_id'], 'id', false);
    }
}
