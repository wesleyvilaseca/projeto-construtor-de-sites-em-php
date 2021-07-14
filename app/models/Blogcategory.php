<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Blogcategory extends DataLayer
{
    public function __construct()
    {
        parent::__construct('blog_categories', ['description', 'enable'], 'id', false);
    }

    public function getCategoryInArray() {
        $categories = $this->find()->fetch(true);
        $a = [];
        $a['n'] = 'Selecione uma opção';
        foreach($categories as $category){
            $a[$category->id] = $category->description;
        }
        return $a;
    }
}
