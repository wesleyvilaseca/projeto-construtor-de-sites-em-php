<?php

namespace app\controllers\institucional\common;

use app\core\Controller;
use app\models\Configsite;
use app\models\Layout;
use app\models\LayoutModules;
use app\models\Module;
use app\models\Theme;

class HomeController extends Controller
{
    private $layout;
    private $config_site;
    private $theme;
    private $html;

    public function __construct()
    {
        $layout                 = new Layout;
        $modules_layout         = new LayoutModules;
        $config_site            = new Configsite;
        $modules                = new Module;
        $theme                  = new Theme;
        $this->config_site      = $config_site->find()->fetch();
        $this->theme            = $theme->findById($this->config_site->theme_id);
        $this->layout           = $layout->findById($this->config_site->homepage_id);

        if ($this->layout->enable == 'S') {
            $layout_modules         = $modules_layout->find("layout_id=:id", "id={$this->config_site->homepage_id}")->order("sort_order ASC")->fetch(true);
            $modules_page = [];
            $i = 0;
            foreach ($layout_modules as $layout_module) {
                if ($layout_module->enable == 'S') $modules_page[] = $modules->findById($layout_module->module_id);

                //if ($i == 6) dd($modules_page[$i]);
                $i++;
            }

            if ($this->layout->header == 'S') $this->html[] = $this->load()->controller('institucional-common-header', [['theme' => $this->theme]]);

            foreach ($modules_page as $module) $this->html[] = $this->load()->controller('institucional-' . $module->module_code, [$module]);

            if ($this->layout->footer == 'S') $this->html[] = $this->load()->controller('institucional-common-footer', [['theme' => $this->theme]]);
        } else {
            $this->html[] = '<div class="alert alert-warning" role="alert">A página selecionada como principal está desabilitada!</div>';
        }
    }

    public function index()
    {
        $dados['title']             = $this->config_site->sitename;
        $dados['theme']             = $this->theme;
        $dados['sections']          = $this->html;
        $dados['js']                = $this->js();
        $view                       = "institucional/pages/home/index";
        $this->renderView($view, $dados);
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        return $js;
    }
}
