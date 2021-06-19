<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\BannerImage;
use app\models\Banners;
use app\models\Module;

//use app\models\Home;

class BannersController extends Controller
{
    private $usuario;
    private $repository;
    private $module;
    private $route = URL_BASE . 'admin-catalog-banners/';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->repository   = new Banners;
        $this->banner_image = new BannerImage;
        $this->module      = new Module;
    }

    public function index()
    {
        //dd($_SESSION['message']);
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Banners', 'active' => true];
        $dados['title']             = 'Banners';
        $dados["toptitle"]          = 'Banners';
        $dados['addroute']          = $this->route . 'add';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['deleteroute']       = $this->route . 'remove/';
        $dados['imagesroute']       = URL_BASE . 'admin-catalog-bannerimage/index/';
        $dados['banners']           = $this->repository->find()->fetch(true);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/index";
        $this->renderView($view, $dados);
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'add', 'title' => 'Novo banner', 'active' => true];
        $dados['title']             = 'Novo Banner';
        $dados["toptitle"]          = 'Novo Banner';
        $dados["back"]              = $this->route;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form();
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/add";
        $this->renderView($view, $dados);
    }

    public function edit(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'edit/' . $id, 'title' => 'Editar banner', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             = 'Editar Banner';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form('update', 'Editar', $item);
        $view                       = "adm/pages/catalog/layout/banners/add";
        $this->renderView($view, $dados);
    }

    public function remove(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'remove/' . $id, 'title' => 'Remover banner', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             = 'Remover Banner';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form('delete', 'Apagar', $item);
        $view                       = "adm/pages/catalog/layout/banners/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {

        $request = $_POST;
        $request = filterpost($request);
        $banner = $this->repository;
        $banner->description = $request['description'];
        $banner->enable      = $request['gallery'] ?: 'N';
        $banner->gallery     = $request['enable'] ?: 'S';
        $bannerId            = $banner->save();
        if ($bannerId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item criado com sucesso']);
            redirect(URL_BASE . 'admin-catalog-banners');
        }
    }

    public function update(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $request    = $_POST;
        if (isset($request))
            $request = filterpost($request);

        $item->description  = $request['description'];
        $item->gallery      = $request['gallery'] ?: 'N';
        $item->enable       = $request['enable'] ?: 'N';
        $itemId = $item->save();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item editado com sucesso']);
            redirect(URL_BASE . 'admin-catalog-banners');
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect(URL_BASE . 'admin-catalog-banners');
        }
    }

    public function delete(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $modules = $this->module->find("JSON_EXTRACT(settings, '$.banner') =:id ", "id={$id}")->fetch();
        if ($modules) {
            setmessage(['tipo' => 'warning', 'msg' => 'Não é possivel remover, o banner possui vinculo com o modulo ' . $modules->description . ' !']);
            redirect($this->route . 'remove/' . $id);
            exit;
        }

        $request    = $_POST;
        if (isset($request))
            $request = filterpost($request);

        $item->description  = $request['description'];
        $item->enable       = $request['enable'];
        $itemId = $item->destroy();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item removido com sucesso']);
            redirect(URL_BASE . 'admin-catalog-banners');
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect(URL_BASE . 'admin-catalog-banners');
        }
    }

    private function form(string $action = 'save', string $buttonlabel = "Salvar", object $data = null)
    {
        $editable = $action == 'delete' ?  false : true;

        $form = new FormWrapper(new Form('formbanner'), $action);
        $description = new Entry('description', $editable);
        $gallery = new Combo('gallery', $editable);
        $gallery->addItems(['N' => 'Não', 'S' => 'Sim']);
        $enable = new Combo('enable', $editable);
        $enable->addItems(['S' => 'Ativo', 'N' => 'Inativo']);

        $form->addField($description,   ['label' => 'Descrição *', 'css' => 'mb-4']);
        $form->addField($gallery,       ['label' => 'É uma galeria de imagens?', 'css' => 'mb-4']);
        $form->addField($enable,        ['label' => 'Situcação *', 'css' => 'mb-4']);

        if ($data) {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => URL_BASE . 'admin-catalog-banners/' . $action . '/' . $data->id]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => URL_BASE . 'admin-catalog-banners/' . $action]);
        }
        return  $form->getForm();
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        return $js;
    }
}
