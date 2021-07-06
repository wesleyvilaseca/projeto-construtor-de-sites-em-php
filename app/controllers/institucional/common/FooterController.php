<?php

namespace app\controllers\institucional\common;

use app\core\Controller;
use app\models\Configsite;

class FooterController extends Controller
{
    private $theme;
    private $logoimage;
    private $logotext;
    private $config;

    public function __construct()
    {
        $config         = new Configsite;
        $this->config   = $config->find()->fetch();
        $this->setLogo();
        $this->setText();
    }

    public function get($params = null)
    {
        $this->theme                = @$params['theme']; 

        $data['brand']             = $this->config->brand;
        $data['logoimage']         = $this->logoimage;
        $data['logotext']          = $this->logotext;
        $data['js']                = $this->js();
        $view                       = $this->theme->root_path_theme . "/footer";
        return $this->loadView($view, $data);
    }

    private function setLogo()
    {
        $this->logoimage = FILEMANAGER['UPLOAD_DIR'] . $this->config->find()->fetch()->logo;
    }

    private function setText()
    {
        $this->logotext[] = $this->config->sitename1;
        $this->logotext[] = $this->config->sitename2;
    }

    private function js()
    {
        //$js = '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        //return $js;
    }
}
