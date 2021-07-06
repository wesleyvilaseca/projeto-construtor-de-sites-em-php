<?php

namespace app\controllers\institucional\common;

use app\core\Controller;
use app\models\Configsite;
use app\models\Departaments;

class HeaderController extends Controller
{
    private $theme;
    private $menus;
    private $departaments;
    private $logoimage;
    private $logotext;
    private $config;

    public function __construct()
    {
        $config = new Configsite;
        $this->departaments = new Departaments;
        $this->config       = $config->find()->fetch();
        $this->setLogo();
        $this->setText();
        $this->getMenu();
    }

    public function get($params = null)
    {
        $this->theme                = @$params['theme'];

        //dd($this->menus);

        $data['brand']             = $this->config->brand;
        $data['logoimage']         = $this->logoimage;
        $data['logotext']          = $this->logotext;
        $data['menus']             = $this->menus;
        $data['js']                = $this->js();
        $view                      = $this->theme->root_path_theme . "/header";
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

    private function getMenu()
    {
        $this->menus = $this->departaments->getMenus();
    }

    public function getfavicon()
    {
        $result = $this->config->favicon;
        if (!$result) {
            echo json_encode(['response' => null, 'success' => false]);
            exit;
        }
        echo json_encode(['response' => ['src' => FILEMANAGER['UPLOAD_DIR'] . $result->favicon], 'success' => true]);
    }

    private function js()
    {
        $js = '<script src="' . URL_BASE . 'assets/institucional/js/vendor/bootnavbar.js"></script>';
        $js .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kmlpandey77/bootnavbar/css/bootnavbar.css">';
        $js .= '<script src="https://cdn.jsdelivr.net/gh/kmlpandey77/bootnavbar/js/bootnavbar.js"></script>';
        $js .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>';
        $js .= '<script src="' . URL_BASE . 'assets/institucional/js/main.js"></script>';
        return $js;
    }
}
