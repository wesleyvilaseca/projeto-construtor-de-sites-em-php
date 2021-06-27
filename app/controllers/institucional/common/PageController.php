<?php

namespace app\controllers\institucional\common;

use app\core\Controller;
use app\models\Configsite;
use app\models\Departaments;
use app\models\Layout;
use app\models\LayoutModules;
use app\models\Module;
use app\models\Theme;

class PageController extends Controller
{
    private $seo;
    private $layout;
    private $theme;
    private $departament;
    private $html;
    private $configsite;

    public function __construct()
    {
        $seo = explode(URL_BASE . 'page/', geturl());
        if (!isset($seo[1])) $this->seo = null;
        else $this->seo = $seo[1];

        $this->pageConstruct();
    }

    public function index()
    {
        $dados['title']             = $this->departament->description;
        $dados['theme']             = $this->theme;
        $dados['sections']          = $this->html;
        $dados['js']                = $this->js();
        $view                       = "institucional/pages/default/index";
        $this->renderView($view, $dados);
    }

    private function pageConstruct()
    {
        $layout             = new Layout;
        $modules_layout     = new LayoutModules;
        $modules            = new Module;
        $theme              = new Theme;
        $departament        = new Departaments;
        $configsite         = new Configsite;

        if (!$this->seo) redirect(URL_BASE);

        $this->departament = $departament->find("seo=:seo", "seo={$this->seo}")->fetch();
        if (!$this->departament->layout_id) redirect(URL_BASE);

        $this->configsite       = $configsite->find()->fetch();
        $this->theme            = $theme->findById($this->configsite->theme_id);
        $this->layout           = $layout->findById($this->departament->layout_id);

        if ($this->layout->enable == 'S') {
            $layout_modules         = $modules_layout->find("layout_id=:id", "id={$this->departament->layout_id}")->order("sort_order ASC")->fetch(true);

            $modules_page = [];

            if ($layout_modules) {
                foreach ($layout_modules as $layout_module) {
                    if ($layout_module->enable == 'S') $modules_page[] = $modules->findById($layout_module->module_id);
                }
            }

            if ($this->layout->header == 'S') $this->html[] = $this->load()->controller('institucional-common-header', [['theme' => $this->theme]]);

            foreach ($modules_page as $module) $this->html[] = $this->load()->controller('institucional-' . $module->module_code, [$module]);

            if ($this->layout->footer == 'S') $this->html[] = $this->load()->controller('institucional-common-footer', [['theme' => $this->theme]]);
        } else {
            $this->html[] = '<div class="alert alert-warning" role="alert">A página selecionada como principal está desabilitada!</div>';
        }
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        return $js;
    }
}
