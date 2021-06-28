<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\Modules;

class TexteditorController extends Controller
{
    private $module;
    private $module_code = 'texteditor';

    public function __construct()
    {
        $module = new Modules;
        $this->module = $module->find("module_code=:module_code", "module_code={$this->module_code}")->fetch();
    }

    public function get($params = null)
    {
        if ($this->module->enable == "N") return null;
        if ($params) $this->setSettings($params);

        return $this->settings['text'];
    }

    private function setSettings($params)
    {
        $settings = json_decode($params->settings);
        $this->settings['text'] = '<div class="container">' . $settings->text . '</div>';
        $this->settings['text'] .= '<style> img {max-width:100%;}</style>';
    }

    private function js()
    {
        //$js = '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        //return $js;
    }
}
