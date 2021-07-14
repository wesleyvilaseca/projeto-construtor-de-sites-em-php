<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Blogarticle extends DataLayer
{
    public function __construct()
    {
        parent::__construct('blog_articles', ['blog_category_id', 'title','description', 'article', 'enable'], 'id', false);
    }
}
