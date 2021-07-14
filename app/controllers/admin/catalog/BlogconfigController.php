<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\Number;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Blogconfig;

class BlogconfigController extends Controller
{

    private $repository;
    private $usuario;
    private $route = URL_BASE . 'admin-catalog-blogconfig/';
    
    public function __construct()
    {
        $this->usuario = $this->getSession();
        $this->repository = new Blogconfig;
    }
    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Config', 'active' => true];
        $dados['title']             = 'Artigos';
        $dados["toptitle"]          = 'Artigos';
        $dados['addroute']          = $this->route . 'add';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['deleteroute']       = $this->route . 'remove/';
        $dados['configs']           = $this->repository->find()->fetch(true);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/config/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Config', 'active' => true];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Nova configuração', 'active' => true];
        $dados['title']             = 'Nova configuração';
        $dados["toptitle"]          = 'Nova configuração';
        $dados["back"]              = $this->route;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['form']              = $this->form();
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/config/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Config', 'active' => true];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Editar configuração', 'active' => true];
        $dados['title']             = 'Editar configuração ' . $item->description;
        $dados["toptitle"]          = 'Editar configuração ' . $item->description;
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('update', 'Editar', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/config/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request                    = $_POST;
        $request                    = filterpost($request);

        $config                         = $this->repository;
        $config->departament_desc       = $request['departament_desc'];
        $config->header                 = $request['header'] ?: 'S';
        $config->footer                 = $request['footer'] ?: 'S';
        $config->articles_per_page      = null;
        $config->enable                 = $request['enable'] ?: 'S';

        $configId                       = $config->save();
        if ($configId) {
            setdataform($request);
            setmessage(['tipo' => 'success', 'msg' => 'Configuração do blog definida com sucesso']);
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

        $item->departament_desc       = $request['departament_desc'];
        $item->header                 = $request['header'] ?: 'S';
        $item->footer                 = $request['footer'] ?: 'S';
        $item->articles_per_page      = null;
        $item->enable                 = $request['enable'] ?: 'S';

        $itemId              = $item->save();
        if ($itemId) {
            setdataform($request);
            setmessage(['tipo' => 'success', 'msg' => 'Configuração do blog definida com sucesso']);
            redirect($this->route);
        }
    }

    private function form(string $action = 'save', string $buttonlabel = "Salvar", object $data = null)
    {
        $form = new FormWrapper(new Form('articles'));
        $form->setActionInBottom(true);

        $editable = $action == 'delete' ? false :  true;

        $description = new Entry('departament_desc', false);
        $description->setProperty('value', 'blog');

        $header = new Combo('header', $editable);
        $header->addItems([
            'S' => 'Sim',
            'N' => 'Não'
        ]);

        $footer = new Combo('footer', $editable);
        $footer->addItems([
            'S' => 'Sim',
            'N' => 'Não'
        ]);

        // $articles_per_page = new Number('articles_per_page', $editable);

        $enable = new Combo('enable', $editable);
        $enable->addItems([
            'S' => 'Ativo',
            'N' => 'Inativo'
        ]);
        $form->addField($description,           ['label' => '', 'css' => 'mb-4']);
        $form->addField($header,                ['label' => 'Mostrar menu?', 'css' => 'mb-4']);
        $form->addField($footer,                ['label' => 'Mostrar rodapé?', 'css' => 'mb-4']);
        // $form->addField($articles_per_page,     ['label' => 'Número de artigos por página *', 'css' => 'mb-4']);
        $form->addField($enable,                ['label' => 'Situação', 'css' => 'mb-4']);
        if ($data) {
            $form->addAction($buttonlabel,  (object)['css' => 'btn btn-success', 'route' => $this->route . $action . '/' . @$data->id, 'submit' => true]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['css' => 'btn btn-success', 'route' => $this->route . $action, 'submit' => true]);
        }
        return  $form->getForm();
    }

    private function js() {
        return null;
    }
}