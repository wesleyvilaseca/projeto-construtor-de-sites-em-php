<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\Modules;

class DefaultsectionController extends Controller
{
    private $settings;
    private $module;
    private $module_code = 'defaultsection';

    public function __construct()
    {
        $module = new Modules;
        $this->module = $module->find("module_code=:module_code", "module_code={$this->module_code}")->fetch();
    }

    public function get($params = null)
    {
        if ($this->module->enable == "N") return null;
        if ($params) $this->setSettings($params);

        $dados['image']             = $this->settings['image'];
        $dados['image_position']    = $this->settings['image_position'];
        $dados['text']              = $this->settings['text'];
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/defaultsection";
        return $this->loadView($view, $dados);
    }

    private function setSettings($params)
    {
        $params = json_decode($params->settings);

        $this->settings['image_position']   = $params->image_position;
        $this->settings['text']             = $params->text;
        $this->settings['image']            = $params->image;
    }

    private function js()
    {
        //$js = '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        //return $js;
    }
}
