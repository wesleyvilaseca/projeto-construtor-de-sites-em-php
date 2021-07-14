<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\Number;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Departaments;
use app\models\Layout;

//use app\models\Home;

class DepartamentController extends Controller
{
    private $usuario;
    private $repository;
    private $layouts;
    private $route = URL_BASE . 'admin-catalog-departament/';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->repository   = new Departaments;
        $this->layouts      = new Layout;
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-departament', 'title' => 'Departamentos', 'active' => true];
        $dados['title']             = 'Departamentos';
        $dados["toptitle"]          = 'Departamentos';
        $dados["departaments"]      =  $this->repository->find()->fetch(true);
        $dados["addroute"]          = $this->route . 'add';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['deleteroute']       = $this->route . 'remove/';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu');
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/departaments/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Departamentos'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'add', 'title' => 'Novo departamento', 'active' => true];
        $dados['title']             = 'Novo Departamento';
        $dados["toptitle"]          = 'Novo Departamento';
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('save', 'Salvar', @getdataform());
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu');
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/departaments/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Departamentos'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'edit/' . $id, 'title' => 'Editar departamento ' . $item->description, 'active' => true];
        $dados['title']             = 'Editar departamento ' . $item->description;
        $dados["toptitle"]          = 'Editar departamento ' . $item->description;
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('update', 'Editar', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu');
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/departaments/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Departamentos'];
        $dados['breadcrumb'][]      = ['route' => $this->route . 'remove/' . $id, 'title' => 'Remover departamento ' . $item->description, 'active' => true];
        $dados['title']             = 'Remover departamento ' . $item->description;
        $dados["toptitle"]          = 'Remover departamento ' . $item->description;
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('delete', 'Remover', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu');
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/departaments/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request                    = $_POST;
        $request                    = filterpost($request);

        $seoexist                   = $this->repository->find('seo=:seo', "seo={$request['seo']}")->fetch();
        if ($seoexist) {
            setdataform($request);
            setmessage(['tipo' => 'warning', 'msg' => 'Já existe uma página com a descrição ' . $request['description'] . ' !']);
            redirectBack();
        }
        //dd($request);

        $departament = $this->repository;
        $departament->description   = $request['description'];
        $departament->top           = $request['top'] ?: 'N';
        $departament->seo           = $request['seo'];
        $departament->parent_id     = $request['parent_id'] ?: null;
        $departament->layout_id     = $request['layout_id'] ?: null;
        $departament->sort_order    = $request['sort_order'] ?: 0;
        $departament->enable        = $request['enable'] ?: 'S';

        $departamentId              = $departament->save();
        if ($departamentId) {
            setdataform($request);
            setmessage(['tipo' => 'success', 'msg' => 'Departamento criado com sucesso']);
            redirect($this->route);
        }
    }

    public function update(string $id)
    {
        if (!$id)
            redirect($this->route);

        $item = $this->repository->findById($id);
        //dd($item);
        if (!$item)
            redirect($this->route);
        $save = function ($item, $request) {
            $item->description   = $request['description'];
            $item->top           = $request['top'] ?: 'N';
            $item->seo           = $request['seo'];
            $item->parent_id     = $request['parent_id'] ?: null;
            $item->layout_id     = $request['layout_id'] ?: null;
            $item->sort_order    = $request['sort_order'] ?: 0;
            $item->enable        = $request['enable'] ?: 'S';
            $itemId              = $item->save();
            if ($itemId) {
                setmessage(['tipo' => 'success', 'msg' => 'Departamento editado com sucesso']);
                redirect($this->route);
            }
        };

        $request                    = $_POST;
        $request                    = filterpost($request);

        if ($request['parent_id'] == $id) {
            $request['id'] = $id;
            setmessage(['tipo' => 'warning', 'msg' => 'O departamento pai não pode ser ele mesme!']);
            setdataform($request);
            redirect($this->route . 'edit/' . $id);
        }


        if ($request['seo'] != $item->seo) {
            $exist = $this->repository->find('seo=:seo', "seo={$request['seo']}")->fetch(true);
            if ($exist) {
                $request['id'] = $id;
                setmessage(['tipo' => 'warning', 'msg' => 'Já existe uma página com o SEO ' . $request['seo'] . ' !']);
                setdataform($request);
                redirect($this->route . 'edit/' . $id);
            } else {
                $save($item, $request);
            }
        } else {
            $save($item, $request);
        }
    }

    public function delete(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $request    = $_POST;
        if (isset($request))
            $request = filterpost($request);

        $itemId = $item->destroy();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Departamento removido com sucesso']);
            redirect($this->route);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route);
        }
    }

    private function form(string $action = 'save', string $buttonlabel = "Salvar", object $data = null)
    {
        $form = new FormWrapper(new Form('departamentos'));
        $form->setActionInBottom(true);

        $description = new Entry('description', $action == 'delete' ? false :  true);
        $description->setProperty('onfocusout', 'departaments.methods.seo(value)');
        $top = new Combo('top', $action == 'delete' ? false :  true);
        $top->addItems(['S' => 'Sim', 'N' => 'Não']);

        $parent_id = new Combo('parent_id', $action == 'delete' ? false :  true);
        $parent_id->addItems($this->repository->getDepartaments());
        $seo = new Entry('seo', $action == 'delete' ? false :  true);

        $layout_id = new Combo('layout_id', $action == 'delete' ? false :  true);
        $layout_id->addItems($this->layouts->list());

        $seo->setProperty('id', 'seo');
        $sort_order = new Number('sort_order', $action == 'delete' ? false :  true);
        $enable = new Combo('enable', $action == 'delete' ? false :  true);
        $enable->addItems([
            'n' => 'Selecione uma opção',
            'S' => 'Ativo',
            'N' => 'Inativo'
        ]);
        $form->addField($description,   ['label' => 'Descrição *', 'css' => 'mb-4']);
        $form->addField($top,           ['label' => 'Mostrar no topo? *', 'css' => 'mb-4']);
        $form->addField($parent_id,     ['label' => 'Departamento pai', 'css' => 'mb-4']);
        $form->addField($seo,           ['label' => 'SEO', 'css' => 'mb-4']);
        $form->addField($layout_id,     ['label' => 'Selecione a página', 'css' => 'mb-4']);
        $form->addField($sort_order,    ['label' => 'Ordem', 'mb-4']);
        $form->addField($enable,        ['label' => 'Situação', 'css' => 'mb-4']);

        if ($data) {
            $form->addAction($buttonlabel,  (object)['css' => 'btn btn-success', 'route' => $this->route . $action . '/' . @$data->id, 'submit' => true]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['css' => 'btn btn-success', 'route' => $this->route . $action, 'submit' => true]);
        }
        return  $form->getForm();
    }

    private function js()
    {
        $js = '<script src="' . URL_BASE . 'assets/adm/js/catalog/departaments/departaments.js" type="text/javascript"></script>';
        $js .= $this->bootstrapjs();
        return $js;
    }
}
