<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class BannerImage extends DataLayer
{
    public function __construct()
    {
        parent::__construct('banner_image', ['banner_id', 'title', 'image'], 'id', false);
    }
}
