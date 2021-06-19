<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;

class ImagegaleryController extends Controller
{
    public function get($params = null)
    {
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/imagegalery";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        $js = $this->magnificPopUp();
        return $js;
    }
}
