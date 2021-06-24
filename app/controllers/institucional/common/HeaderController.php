<?php

namespace app\controllers\institucional\common;

use app\core\Controller;
use app\models\Departaments;

class HeaderController extends Controller
{
    private $theme;
    private $menus;
    private $departaments;

    public function __construct()
    {
        $this->departaments = new Departaments;
        $this->getMenu();
    }

    public function get($params = null)
    {
        $this->theme                = @$params['theme'];

        //dd($this->menus);

        $dados['menus']             = $this->menus;
        $dados['js']                = $this->js();
        $view                       = $this->theme->root_path_theme . "/header";
        return $this->loadView($view, $dados);
    }

    private function getMenu()
    {
        $this->menus = $this->departaments->getMenus();
    }

    private function js()
    {
        $js = '<script src="' . URL_BASE . 'assets/institucional/js/vendor/bootnavbar.js"></script>';
        $js.='<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kmlpandey77/bootnavbar/css/bootnavbar.css">';
        $js.='<script src="https://cdn.jsdelivr.net/gh/kmlpandey77/bootnavbar/js/bootnavbar.js"></script>';
        $js.='<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>';
        $js.= '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        return $js;
    }
}
