<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;

class CardssectionController extends Controller
{
    public function get($params = null)
    {
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/cardssection";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        $js = $this->isotope();
        return $js;
    }
}
