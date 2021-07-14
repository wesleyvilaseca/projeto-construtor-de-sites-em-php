<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Banners extends DataLayer
{
    public function __construct()
    {
        parent::__construct('banners', ['description', 'enable'], 'id', false);
    }

    public function imageGalleryList(){
        $galleries = $this->find("gallery=:gallery", "gallery=S")->fetch(true);
        $a = [];
        $a['n'] = 'Selecione uma opção';
        $a[null] = "-- vazio --";
        foreach($galleries as $gallery){
            $a[$gallery->id] = $gallery->description;
        }
        return $a;
    }
}
