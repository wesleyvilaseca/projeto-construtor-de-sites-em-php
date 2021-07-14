<?php

namespace app\controllers\institucional\blog;

use app\core\Controller;
use app\models\Blogconfig;
use app\models\Configsite;
use app\models\Theme;

class BlogController extends Controller
{
    private $theme;
    private $html;
    private $blogconfig;

    public function __construct()
    {
        $configsite         = new Configsite;
        $blogconfig         = new Blogconfig;
        $theme              = new Theme;
        $this->blogconfig   = $blogconfig->find()->fetch();
        $this->theme        = $theme->findById($configsite->find()->fetch()->theme_id);
    }

    public function index()
    {
        $dados['title']             = 'Blog';
        $dados['theme']             = $this->theme;
        $dados['sections']          = $this->html;
        $dados['header']            = $this->blogconfig->header == "S" ? $this->load()->controller('institucional-common-header', [['theme' => $this->theme]]) : '';
        $dados['footer']            = $this->blogconfig->footer == "S" ? $this->load()->controller('institucional-common-footer', [['theme' => $this->theme]]) : '';
        $dados['js']                = $this->js();
        $view                       = "institucional/pages/blog/index";
        $this->renderView($view, $dados);
    }

    private function js()
    {
        return null;
    }
}
