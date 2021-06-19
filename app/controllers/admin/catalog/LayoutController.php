<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Layout;
use app\models\Module;

//use app\models\Home;

class LayoutController extends Controller
{
    private $usuario;
    private $repository;
    private $module;
    private $route = URL_BASE . 'admin-catalog-layout/';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->repository   = new Layout;
        $this->module       = new Module;
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Layout', 'active' => true];
        $dados['title']             = 'Páginas';
        $dados["toptitle"]          = 'Páginas';
        $dados['paginas']           = $this->repository->find()->fetch(true);
        $dados['addroute']          = $this->route . 'add/';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['deleteroute']       = $this->route . 'remove/';
        $dados['layoutroute']       = URL_BASE . 'admin-catalog-layoutmodules/index/';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Layout'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'add/', 'title' => 'Nova página', 'active' => true];
        $dados['title']             = 'Nova Página';
        $dados["toptitle"]          = 'Nova Página';
        $dados['back']              = $this->route;
        $dados['form']              = $this->form('save', 'Salvar', @getdataform());
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/add";
        $this->renderView($view, $dados);
    }

    public function edit(string $id)
    {
        if (!$id)
            redirectBack();

        $item                       = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Layout'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'edit/' . $id, 'title' => 'Editar página ' . $item->description, 'active' => true];
        $dados['title']             = 'Nova Página';
        $dados["toptitle"]          = 'Nova Página';
        $dados['back']              = $this->route;
        $dados['form']              = $this->form('update', 'Editar', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/add";
        $this->renderView($view, $dados);
    }

    public function remove(string $id)
    {
        if (!$id)
            redirectBack();

        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Layout'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'remove/' . $id, 'title' => 'Remover página ' . $item->description, 'active' => true];
        $dados['title']             = 'Remover Página';
        $dados["toptitle"]          = 'Remover Página';
        $dados['back']              = $this->route;
        $dados['form']              = $this->form('delete', 'Remover', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request                    = $_POST;
        $request                    = filterpost($request);

        if (!$request['description']) {
            setdataform($request);
            setmessage(['tipo' => 'warning', 'msg' => 'Os campos com (*) são de preenchimento obrigatório!']);
            redirectBack($this->route . 'add/');
        }

        $page                       = $this->repository;
        $page->description          = $request['description'];
        $page->header               = $request['header'] ?: 'S';
        $page->footer               = $request['footer'] ?: 'S';
        $page->enable               = $request['enable'] ?: 'S';
        $pageId                     = $page->save();
        if ($pageId) {
            setmessage(['tipo' => 'success', 'msg' => 'Página criada com sucesso, defina os compenentes da página no Layout!']);
            redirect($this->route);
        }
    }


    public function update(string $id)
    {
        if (!$id)
            redirect($this->route);

        $item = $this->repository->findById($id);
        if (!$item)
            redirect($this->route);

        $request                    = $_POST;
        $request                    = filterpost($request);

        if (!$request['description']) {
            $request['id'] = $id;
            setdataform($request);
            setmessage(['tipo' => 'warning', 'msg' => 'Os campos com (*) são de preenchimento obrigatório!']);
            redirectBack($this->route . 'edit/' . $id);
        }

        $item->description          = $request['description'];
        $item->header               = $request['header'] ?: 'S';
        $item->footer               = $request['footer'] ?: 'S';
        $item->enable               = $request['enable'] ?: 'S';
        $itemId                     = $item->save();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Página editada com sucesso']);
            redirect($this->route);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route);
        }
    }

    private function delete(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $request    = $_POST;
        if (isset($request))
            $request = filterpost($request);

        $itemId = $item->destroy();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Página removida com sucesso']);
            redirect($this->route);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route);
        }
    }

    private function form(string $action = 'save', string $buttonlabel = "Salvar", object $data = null)
    {
        $editable = $action == 'delete' ? false : true;

        $form           = new FormWrapper(new Form('layou'));
        $description    = new Entry('description', $editable);
        $header         = new Combo('header',  $editable);
        $header->addItems([ "S" => "Sim", "N" => "Não"]);

        $footer         = new Combo('footer',  $editable);
        $footer->addItems(["S" => "Sim", "N" => "Não" ]);

        $enable         = new Combo('enable',  $editable);
        $enable->addItems(['S' => 'Ativo','N' => 'Inativo']);
        $form->addField($description,   ['label' => 'Descrição *','css' => 'mb-4']);
        $form->addField($header,        ['label' => 'Mostrar menus','css' => 'mb-4']);
        $form->addField($footer,        ['label' => 'Mostrar rodapé', 'mb-4']);
        $form->addField($enable,        ['label' => 'Situação', 'css' => 'mb-4']);

        if ($data) {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => $this->route . $action . '/' . @$data->id]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => $this->route . $action]);
        }
        return  $form->getForm();
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        return $js;
    }
}