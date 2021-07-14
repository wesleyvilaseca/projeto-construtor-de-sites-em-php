<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Blogcategory;

class BlogcategoryController extends Controller
{
    private $repository;
    private $route = URL_BASE . 'admin-catalog-blogcategory/';

    public function __construct()
    {
        $this->repository   = new Blogcategory;
        $this->usuario      = $this->getSession();
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Categorias', 'active' => true];
        $dados['title']             = 'Blog Categorias';
        $dados["toptitle"]          = 'Blog Categorias';
        $dados['addroute']          = $this->route . 'add';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['deleteroute']       = $this->route . 'remove/';
        $dados['categories']        = $this->repository->find()->fetch(true);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/categories/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog Categoria'];
        $dados['breadcrumb'][]      = ['route' => '#' . 'add', 'title' => 'Nova Categoria', 'active' => true];
        $dados['title']             = 'Nova categoria';
        $dados["toptitle"]          = 'Nova categoria';
        $dados["back"]              = $this->route;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['form']              = $this->form();
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/categories/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog Categoria'];
        $dados['breadcrumb'][]      = ['route' => '#' . 'add', 'title' => 'Editar Categoria', 'active' => true];
        $dados['title']             = 'Editar categoria ' . $item->description;
        $dados["toptitle"]          = 'Editar categoria ' . $item->description;
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('update', 'Editar', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/categories/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog Categoria'];
        $dados['breadcrumb'][]      = ['route' => '#' . 'add', 'title' => 'Remover Categoria', 'active' => true];
        $dados['title']             = 'remover departamento ' . $item->description;
        $dados["toptitle"]          = 'remover departamento ' . $item->description;
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('delete', 'Remover', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/categories/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request                    = $_POST;
        $request                    = filterpost($request);

        $departament = $this->repository;
        $departament->description   = $request['description'];
        $departament->enable        = $request['enable'] ?: 'S';

        $departamentId              = $departament->save();
        if ($departamentId) {
            setdataform($request);
            setmessage(['tipo' => 'success', 'msg' => 'Categoria criado com sucesso']);
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

        $item->description   = $request['description'];
        $item->enable        = $request['enable'] ?: 'S';

        $itemId              = $item->save();
        if ($itemId) {
            setdataform($request);
            setmessage(['tipo' => 'success', 'msg' => 'Categoria editado com sucesso']);
            redirect($this->route);
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
            setmessage(['tipo' => 'success', 'msg' => 'Categoria removida com sucesso']);
            redirect($this->route);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route);
        }
    }

    private function form(string $action = 'save', string $buttonlabel = "Salvar", object $data = null)
    {
        $editable = $action == 'delete' ?  false : true;

        $form = new FormWrapper(new Form('form_blog_categ'), $action);
        $description = new Entry('description', $editable);
        $enable = new Combo('enable', $editable);
        $enable->addItems(['S' => 'Ativo', 'N' => 'Inativo']);

        $form->addField($description,   ['label' => 'Descrição *', 'css' => 'mb-4']);
        $form->addField($enable,        ['label' => 'Situcação *', 'css' => 'mb-4']);

        if ($data) {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => $this->route . $action . '/' . $data->id]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => $this->route . $action]);
        }
        return  $form->getForm();
    }


    private function js()
    {
        return null;
    }
}
