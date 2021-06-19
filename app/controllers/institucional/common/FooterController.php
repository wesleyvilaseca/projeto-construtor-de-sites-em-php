<?php

namespace app\controllers\institucional\common;

use app\core\Controller;

class FooterController extends Controller
{
    private $theme;

    public function get($params = null)
    {
        $this->theme                = @$params['theme']; 

        $dados['js']                = $this->js();
        $view                       = $this->theme->root_path_theme . "/footer";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        //$js = '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        //return $js;
    }
}
