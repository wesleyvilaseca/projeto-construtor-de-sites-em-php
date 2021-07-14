<?php

namespace app\controllers\admin\common;

use app\core\Controller;
use app\models\Modules;

class SidemenuController extends Controller
{
    private $menu;

    public function __construct()
    {
        #os menus id é a rota dos controllers dos menus
        $this->menu[] = ['menuid' => 'admin-catalog-home', 'name' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'url' => URL_BASE . 'admin-catalog-home'];

        $this->menu[] = ['menuid' => 'admin-catalog-departament', 'name' => 'Departamentos', 'icon' => 'fas fa-code-branch', 'url' => URL_BASE . 'admin-catalog-departament'];

        $this->menu[] = ['menuid' => 'admin-catalog-modules', 'name' => 'Modulos', 'icon' => 'fab fa-buromobelexperte', 'children' => [
            [
                'menuid' => 'admin-catalog-modules',
                'name' => 'Modulos',
                'url' => URL_BASE . 'admin-catalog-modules'
            ],
            [
                'menuid' => 'admin-outro',
                'name' => 'Outros',
                'url' => URL_BASE . 'admin-modules'
            ]
        ]];

        $this->menu[] = ['menuid' => 'admin-catalog-layout', 'name' => 'Layout', 'icon' => 'fas fa-tv', 'children' => [
            [
                'menuid' => 'admin-catalog-layout',
                'name' => 'Páginas',
                'url' =>  URL_BASE . 'admin-catalog-layout'
            ],
            [
                'menuid' => 'admin-catalog-banners',
                'name' => 'Banners',
                'url' =>  URL_BASE . 'admin-catalog-banners'
            ]
        ]];

        $this->menu[] = ['menuid' => 'admin-catalog-configsite', 'name' => 'Configurações', 'icon' => 'fas fa-cog', 'children' => [
            [
                'menuid'    => 'admin-catalog-configsite',
                'name'      => 'Configurações do site',
                'url'       => URL_BASE . 'admin-catalog-configsite'
            ]
        ]];

        $this->menu[] = ['menuid' => 'admin-catalog-blog', 'name' => 'Blog', 'icon' => 'fas fa-newspaper', 'children' => [
            [
                'menuid'    => 'admin-catalog-blogcategory',
                'name'      => 'Categorias',
                'url'       => URL_BASE . 'admin-catalog-blogcategory'
            ],
            [
                'menuid'    => 'admin-catalog-blogarticle',
                'name'      => 'Artigos',
                'url'       => URL_BASE . 'admin-catalog-blogarticle'
            ],
            [
                'menuid'    => 'admin-catalog-blogconfig',
                'name'      => 'Configuração do blog',
                'url'       => URL_BASE . 'admin-catalog-blogconfig'
            ]
        ]];

        $this->menuModule();
    }

    public function get($params = null)
    {
        $dados['menus']             = $this->menu;
        $dados['menuparantkey']     = $params;
        $dados['js']                = $this->js();
        $view                       = "adm/template/sidemenu";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        $js = '<script src="' . URL_BASE . 'assets/adm/js/plugins/sidebar/sidebar.js" type="text/javascript"></script>';
        $js .= $this->bootstrapjs();
        return $js;
    }

    private function menuModule()
    {

        $modules = new Modules;
        //logica para ativar o menu ref ao informativo

        $informative = $modules->find("module_code=:code", "code=informative")->fetch();
        if ($informative->enable == 'S')
            $this->menu[] = ['menuid' => 'admin-catalog-informative', 'name' => 'Informativo', 'icon' => 'far fa-envelope', 'url' => ""];
    }
}
