<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Layout extends DataLayer
{
    public function __construct()
    {
        parent::__construct('layout', ['description', 'enable'], 'id', false);
    }

    public function list() {
        $blog = new Blogconfig;
        $layouts = $this->find("enable=:enable", "enable=S")->fetch(true);
        $a = [];
        $a['n'] = 'Selecione uma opção';
        foreach($layouts as $layout){
            $a[$layout->id] = $layout->description;
        }

        $configBlog = $blog->find()->fetch();
        if($configBlog->enable == "S"){
            $a[null] = "Blog";
        }
        return $a;
    }
}
