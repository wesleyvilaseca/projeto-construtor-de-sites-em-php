<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\Configsite;
use app\models\Layout;
use app\models\Theme;

//use app\models\Home;

class ConfigsiteController extends Controller
{
    private $usuario;
    private $repository;
    private $layout;
    private $theme;
    private $route = URL_BASE . 'admin-catalog-configsite/';

    public function __construct()
    {
        $this->repository   = new Configsite;
        $this->layout       = new Layout;
        $this->theme        = new Theme;
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Configuração do site', 'active' => true];
        $dados['title']             = 'Configuração do site';
        $dados["toptitle"]          = 'Configuração do site';
        $dados['addroute']          = $this->route . 'add';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['configs']           = $this->repository->find()->fetch(true);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-configsite']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/config/config/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Configuração do site'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Cadastro de configuração', 'active' => true];
        $dados['title']             = 'Cadastro configuração do site';
        $dados["toptitle"]          = 'Cadastro configuração do site';
        $dados['image']             =  URL_BASE . 'assets/adm/img/images/default.jpg';
        $dados['pages']             = $this->layout->find()->fetch(true);
        $dados['themes']            = $this->theme->find()->fetch(true);
        $dados['action']            = $this->route . 'save';
        $dados['button']            = 'Salvar';
        $dados['back']              = $this->route;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-configsite']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/config/config/add";
        $this->renderView($view, $dados);
    }

    public function edit(string $id)
    {
        if (!$id)
            redirectBack();

        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Configuração do site'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'edit/' . $id, 'title' => 'Editar configuração', 'active' => true];
        $dados['title']             = 'Editar configuração';
        $dados["toptitle"]          = 'Editar configuração';
        $dados['config_site']       = $item;
        $dados['image']             =  URL_BASE . 'assets/adm/img/images/default.jpg';
        $dados['pages']             = $this->layout->find()->fetch(true);
        $dados['themes']            = $this->theme->find()->fetch(true);
        $dados['action']            = $this->route . 'update/' . $id;
        $dados['button']            = 'Salvar';
        $dados['back']              = $this->route;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-configsite']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/config/config/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request = $_POST;
        $address = $request['address'];
        $request = filterpost($request);
        $request['address'] = $address;


        $config                 = $this->repository;
        $config->logo           = $request['logo'];
        $config->favicon        = $request['favicon'];
        $config->fone           = $request['fone'];
        $config->address        = $request['address'];
        $config->host           = $request['host'];
        $config->port           = $request['port'];
        $config->sitename       = $request['sitename'];
        $config->homepage_id    = $request['homepage_id'];
        $config->theme_id       = $request['theme_id'];
        $config->email          = $request['email'];
        $config->password       = $request['password'];
        $configId               = $config->save();
        if ($configId) {
            $this->themeSessionUpdate();
            setmessage(['tipo' => 'success', 'msg' => 'Configuração definida com sucesso!']);
            redirect($this->route);
        }
    }

    public function update(string $id)
    {
        if (!$id)
            redirectBack();

        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $request = $_POST;
        $address = $request['address'];
        $request = filterpost($request);
        $request['address'] = $address;

        $item->logo           = $request['logo'];
        $item->favicon        = $request['favicon'];
        $item->fone           = $request['fone'];
        $item->address        = $request['address'];
        $item->host           = $request['host'];
        $item->port           = $request['port'];
        $item->sitename       = $request['sitename'];
        $item->homepage_id    = $request['homepage_id'];
        $item->theme_id       = $request['theme_id'];
        $item->email          = $request['email'];
        $item->password       = $request['password'];
        $itemId               = $item->save();
        if ($itemId) {
            $this->themeSessionUpdate();
            setmessage(['tipo' => 'success', 'msg' => 'Configuração atualizada com sucesso!']);
            redirect($this->route);
        }
    }


    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->fancybox_js();
        $js .= $this->tinyEditorActive();
        return $js;
    }

    private function themeSessionUpdate()
    {
        $id_theme           = ($this->repository->find()->fetch())->theme_id;
        setSession('theme', json_encode($this->theme->findById($id_theme)->data()));
    }
}
