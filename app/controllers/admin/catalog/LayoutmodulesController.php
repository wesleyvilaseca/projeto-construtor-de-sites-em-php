<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\Hidden;
use app\classes\widgets\form\Number;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Layout;
use app\models\LayoutModules;
use app\models\Module;

//use app\models\Home;

class LayoutmodulesController extends Controller
{
    private $usuario;
    private $repository;
    private $module;
    private $layout;
    private $route = URL_BASE . 'admin-catalog-layoutmodules/';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->repository   = new LayoutModules;
        $this->layout       = new Layout;
        $this->module       = new Module;
    }

    public function index(string $idlayout)
    {
        if (!$idlayout) redirectBack();

        $page = $this->layout->findById($idlayout);
        if (!$page) redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-layout', 'title' => 'Layout'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'index/' . $idlayout, 'title' => 'Modulos da página ' . $page->description, 'active' => true];
        $dados['title']             = 'Modulos da página ' . $page->description;
        $dados["toptitle"]          = 'Modulos da página ' . $page->description;
        $dados['list_leftcol']      = $this->load()->controller('admin-components-tablelistLayoutModules', [
            [
                "list"          => $this->repository->list($position = 'L', $idlayout),
                "editroute"     => $this->route . 'edit/' . $idlayout . '/',
                "deleteroute"   => $this->route . 'remove/' . $idlayout . '/'
            ]
        ]);
        $dados['list_center']       = $this->load()->controller('admin-components-tablelistLayoutModules', [
            [
                "list"          => $this->repository->list($position = 'C', $idlayout),
                "editroute"     => $this->route . 'edit/' . $idlayout . '/',
                "deleteroute"   => $this->route . 'remove/' . $idlayout . '/'
            ]
        ]);
        $dados['list_rightcol']     = $this->load()->controller('admin-components-tablelistLayoutModules', [
            [
                "list"          => $this->repository->list($position = 'R', $idlayout),
                "editroute"     => $this->route . 'edit/' . $idlayout . '/',
                "deleteroute"   => $this->route . 'remove/' . $idlayout . '/'
            ]
        ]);
        $dados['addroute']          = $this->route . 'add/' . $idlayout . '/';
        $dados['editroute']         = $this->route . 'edit/' . $idlayout . '/';
        $dados['deleteroute']       = $this->route . 'remove/' . $idlayout . '/';
        $dados['back']              = URL_BASE . 'admin-catalog-layout';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/modules-layout/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add(string $idlayout)
    {
        if (!$idlayout)
            redirectBack();

        $page = $this->layout->findById($idlayout);
        if (!$page)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-layout', 'title' => 'Layout'];
        $dados['breadcrumb'][]      = ['route' => $this->route  . 'index/' . $idlayout, 'title' => 'Modulos da página ' . $page->description];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Novo modulo', 'active' => true];
        $dados['title']             = 'Novo Modulo';
        $dados["toptitle"]          = 'Novo Modulo';
        $dados['back']              = $this->route . 'index/' . $idlayout;
        $dados['form']              = $this->form($idlayout, 'save', 'Salvar', @getdataform());
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/modules-layout/add";
        $this->renderView($view, $dados);
    }

    public function edit(string $idlayout, string $id_module)
    {
        if (!$idlayout)
            redirectBack();

        $page = $this->layout->findById($idlayout);
        if (!$page)
            redirectBack();

        $item                       = $this->repository->findById($id_module);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-layout', 'title' => 'Layout'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'index/' . $idlayout, 'title' => 'Modulos da página ' . $page->description];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Editar modulo da página ' . $item->description, 'active' => true];
        $dados['title']             = 'Editar modulo';
        $dados["toptitle"]          = 'Editar modulo';
        $dados['back']              = $this->route . 'index/' . $idlayout;
        $dados['form']              = $this->form($idlayout, 'update', 'Editar', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/add";
        $this->renderView($view, $dados);
    }

    public function remove(string $idlayout, string $id_module)
    {
        if (!$idlayout)
            redirectBack();

        $page = $this->layout->findById($idlayout);
        if (!$page)
            redirectBack();

        $item                       = $this->repository->findById($id_module);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-layout', 'title' => 'Layout'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'index/' . $idlayout, 'title' => 'Modulos da página ' . $page->description];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Remover modulo da página ' . $item->description, 'active' => true];
        $dados['title']             = 'Remover modulo';
        $dados["toptitle"]          = 'Remover modulo';
        $dados['back']              = $this->route . 'index/' . $idlayout;
        $dados['form']              = $this->form($idlayout, 'delete', 'Remover', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/layout/add";
        $this->renderView($view, $dados);
    }

    public function save(string $idlayout)
    {
        if (!$idlayout)
            redirectBack();

        $page = $this->layout->findById($idlayout);
        if (!$page)
            redirectBack();

        $request                    = $_POST;
        $request                    = filterpost($request);

        if (!$request['layout_id'] || !$request['module_id'] || !$request['position']) {
            setdataform($request);
            setmessage(['tipo' => 'warning', 'msg' => 'Os campos com (*) são de preenchimento obrigatório!']);
            redirectBack($this->route . 'add/' . $idlayout);
        }

        $layout_module              = $this->repository;
        $layout_module->layout_id   = $request['layout_id'];
        $layout_module->module_id   = $request['module_id'];
        $layout_module->position    = $request['position'];
        $layout_module->sort_order  = $request['sort_order'];
        $layout_module->enable      = $request['enable'];
        $layout_moduleId            = $layout_module->save();
        if ($layout_moduleId) {
            setmessage(['tipo' => 'success', 'msg' => 'Modulo adicionado com sucesso!']);
            redirect($this->route . 'index/' . $idlayout);
        }
    }


    public function update(string $idlayout, string $idlayout_module)
    {
        if (!$idlayout || !$idlayout_module)
            redirectBack();

        $item = $this->repository->findById($idlayout_module);
        if (!$item)
            redirectBack();

        $request                    = $_POST;
        $request                    = filterpost($request);

        if (!$request['layout_id'] || !$request['module_id'] || !$request['position']) {
            $request['id'] = $idlayout_module;
            setdataform($request);
            setmessage(['tipo' => 'warning', 'msg' => 'Os campos com (*) são de preenchimento obrigatório!']);
            redirect($this->route . 'edit/' . $idlayout . '/' . $idlayout_module);
        }

        $item->layout_id            = $request['layout_id'];
        $item->module_id            = $request['module_id'];
        $item->position             = $request['position'];
        $item->sort_order           = $request['sort_order'];
        $item->enable               = $request['enable'] ?: 'S';
        $itemId                     = $item->save();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Página editada com sucesso']);
            redirect($this->route . 'index/' . $idlayout);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route . 'index/' . $idlayout);
        }
    }

    public function delete(string $idlayout, string $idlayout_module)
    {
        if (!$idlayout || !$idlayout_module) redirectBack();

        $item = $this->repository->findById($idlayout_module);
        if (!$item) redirectBack();

        $itemId = $item->destroy();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Página removida com sucesso']);
            redirect($this->route . 'index/' . $idlayout);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route . 'index/' . $idlayout);
        }
    }

    private function form(string $idlayout, string $action = 'save', string $buttonlabel = "Salvar", $data = null)
    {
        $readyonly = $action == 'delete' ? false : true;

        $form = new FormWrapper(new Form('form_moduleslayout'));
        $module_id = new Combo('module_id', $readyonly);
        $module_id->addItems($this->module->getmodules());
        $position = new Combo('position', $readyonly);
        $position->addItems([
            'n' => 'Selecione uma opção',
            'L' => 'Coluna esquerda',
            'C' => 'Centro da página',
            'R' => 'Coluna direita'
        ]);
        $sort_order = new Number('sort_order', $readyonly);
        $enable = new Combo('enable', $readyonly);
        $enable->addItems(['S' => 'Ativo', 'N' => 'Inativo']);
        $layout_id = new Hidden('layout_id');
        $layout_id->setProperty('value', $idlayout);

        $form->addField($module_id,     ['label' => 'Modulo *', 'css' => 'mb-4']);
        $form->addField($position,      ['label' => 'Posição *', 'css' => 'mb-4']);
        $form->addField($sort_order,    ['label' => 'Ordem', 'css' => 'mb-4']);
        $form->addField($enable,        ['label' => 'Situação', 'css' => 'mb-4']);
        $form->addField($layout_id, []);

        if ($data) {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => $this->route . $action . '/' . $idlayout . '/' . @$data->id]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => $this->route . $action . '/' . $idlayout]);
        }
        return  $form->getForm();
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        return $js;
    }
}
