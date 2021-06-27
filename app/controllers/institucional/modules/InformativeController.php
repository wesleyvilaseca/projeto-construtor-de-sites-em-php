<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\Module;
use app\models\Modules;

class InformativeController extends Controller
{
    private $settings;
    private $module;
    private $module_code = 'informative';

    public function __construct()
    {
        $module = new Modules;
        $this->module = $module->find("module_code=:module_code", "module_code={$this->module_code}")->fetch();
    }

    public function get($params = null)
    {
        if ($this->module->enable == "N") return null;

        if ($params) $this->setSettings($params);
        
        $dados['title']             = @$this->settings['title'];
        $dados['subtitle']          = @$this->settings['subtitle'];
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/informative";
        return $this->loadView($view, $dados);
    }

    private function setSettings($params)
    {
        $settings                       = json_decode($params->settings);
        $this->settings['title']        = @$settings->title;
        $this->settings['subtitle']     = @$settings->subtitle;
    }

    private function js()
    {
        //$js = '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        //return $js;
    }
}
