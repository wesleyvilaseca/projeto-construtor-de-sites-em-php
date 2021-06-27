<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\Modules;

class BrandssectionController extends Controller
{
    private $module;
    private $module_code = 'brand';

    public function __construct()
    {
        $module = new Modules;
        $this->module = $module->find("module_code=:module_code", "module_code={$this->module_code}")->fetch();
    }

    public function get($params = null)
    {
        if ($this->module->enable == "N") return null;

        $dados['js']                = $this->js();
        $view                       = "institucional/modules/brandssection";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        //$js = '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        //return $js;
    }
}
