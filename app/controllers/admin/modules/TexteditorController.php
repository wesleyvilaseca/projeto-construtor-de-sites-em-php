<?php

namespace app\controllers\admin\modules;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\ImputFile;
use app\classes\widgets\form\Text;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Banners;
use app\models\Module;

class TexteditorController extends Controller
{
    private $repository;
    private $usuario;
    private $route          = URL_BASE . 'admin-modules-texteditor/';
    private $module_code    = 'modules-texteditor'; //rota no site institucional

    public function __construct()
    {
        $this->repository   = new Module;
        $this->banners      = new Banners;
        $this->usuario      = $this->getSession();
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-modules', 'title' => 'Modulos'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Text Editor', 'active' => true];
        $dados['title']             = 'Text editor';
        $dados["toptitle"]          = 'Text editor';
        $dados['actionadd']         = $this->route . 'add';
        $dados['back']              = URL_BASE . 'admin-catalog-modules';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['tablelist']         = $this->load()->controller('admin-components-tablelistmodules', [
            [
                'lista'         => $this->repository->find('module_code =:module_code', "module_code={$this->module_code}")->fetch(true),
                'actionroute'   => $this->route
            ]
        ]);
        $view                       = 'adm/pages/catalog/modules/default/index';
        $this->renderView($view, $dados);
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-modules', 'title' => 'Modulos'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Text Editor'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Novo', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             = 'Novo';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['form']              = $this->form();
        $dados['js']                = $this->js();
        $view                       =  'adm/pages/catalog/modules/default/add';
        $this->renderView($view, $dados);
    }

    public function edit(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-modules', 'title' => 'Modulos'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Text Editor'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Editar', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             = 'Novo Slide';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['form']              = $this->form('update', 'Editar', $item);
        $dados['js']                = $this->js();
        $view                       =  'adm/pages/catalog/modules/default/add';
        $this->renderView($view, $dados);
    }

    public function remove(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-modules', 'title' => 'Modulos'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Text Editor'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Remover', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             = 'Remover';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['form']              = $this->form('delete', 'Apagar', $item);
        $view                       = 'adm/pages/catalog/modules/default/add';
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request                = $_POST;
        $text                   = $request['text'];
        $request                = filterpost($request);
        $request['text']        = $text;

        $section                = $this->repository;
        $section->description   = $request['description'];
        $section->enable        = $request['enable'];
        $section->module_code   = $this->module_code;
        $section->settings      = module_settings($request);

        $sectionId            = $section->save();
        if ($sectionId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item criado com sucesso']);
            redirect($this->route);
        };
    }

    public function update(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $request            = $_POST;
        $text               = $request['text'];

        if (isset($request)) $request = filterpost($request);

        $request['text']    = $text;

        $item->description  = $request['description'];
        $item->enable       = $request['enable'];
        $item->settings     = module_settings($request);
        $itemId = $item->save();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item editado com sucesso']);
            redirect($this->route);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route);
        }
    }

    public function delete(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $item->destroy();
        setmessage(['tipo' => 'success', 'msg' => 'Item removido com successo']);
        redirect($this->route);
    }

    private function form(string $action = 'save', string $buttonlabel = "Salvar", object $data = null)
    {
        $editable =  $action == 'delete' ?  false :  true;
        $form           = new FormWrapper(new Form('formslidefullwidth'));
        $description    = new Entry('description', $editable);
        $text           = new Text('text', $editable);

        $enable = new Combo('enable', $editable);
        $enable->addItems(['S' => 'Ativo', 'N' => 'Inativo']);

        $form->addField($description,   ['label' => 'Descrição *', 'css' => 'mb-4']);
        $form->addField($text,          ['label' => 'Conteudo *', 'css' => 'mb-4', 'editor' => $editor = true]);
        $form->addField($enable,        ['label' => 'Situcação *', 'css' => 'mb-4']);

        if ($data) {
            $form->addAction($buttonlabel, (object)['css' => 'btn btn-success', 'route' => $this->route . $action . '/' . $data->id, 'submit' => true]);
            $form->setData(dataModule($data));
        } else {
            $form->addAction($buttonlabel, (object)['css' => 'btn btn-success', 'route' => $this->route . $action, 'submit' => true]);
        }
        return  $form->getForm();
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->fancybox_js();
        $js .= $this->tinyEditorActive();
        return $js;
    }
}
