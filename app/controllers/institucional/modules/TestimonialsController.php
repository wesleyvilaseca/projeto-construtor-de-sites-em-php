<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;

class TestimonialsController extends Controller
{
    public function get($params = null)
    {
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/testimonials";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        $js = $this->carousel_js();
        $js .= $this->carousel_min_js();
        return $js;
    }
}
