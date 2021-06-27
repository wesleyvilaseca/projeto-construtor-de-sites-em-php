<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\Modules;

class AboutController extends Controller
{

    private $module;

    public function __construct()
    {
        $module = new Modules;
        $this->module = $module->find("module_code=:module_code", "module_code=informative")->fetch();
    }

    public function get($params = null)
    {
        if ($this->module->enable == "N") return null;
        
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
