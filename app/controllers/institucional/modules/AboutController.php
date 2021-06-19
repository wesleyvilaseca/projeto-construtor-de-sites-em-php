<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;

class AboutController extends Controller
{
    public function get($params = null)
    {
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/about";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        //$js = '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        //return $js;
    }
}
