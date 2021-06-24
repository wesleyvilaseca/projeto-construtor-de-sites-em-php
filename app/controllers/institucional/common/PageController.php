<?php

namespace app\controllers\institucional\common;

use app\core\Controller;

class PageController extends Controller
{
    private $seo;

    public function __construct()
    {
        $seo = explode(URL_BASE . 'page/', geturl());
        if(!isset($seo[1])) $this->seo = null;
        else $this->seo = $seo[1];
    }

    public function index(){
        //montar página a partir do seo;
        $page = $this->seo;
    }
}
