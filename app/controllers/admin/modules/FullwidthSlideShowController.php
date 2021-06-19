<?php

namespace app\controllers\admin\modules;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Banners;
use app\models\Module;

class FullwidthSlideShowController extends Controller
{
    private $repository;
    private $banners;
    private $usuario;
    private $route = URL_BASE . 'admin-modules-fullwidthSlideShow/';
    private $module_code = 'modules-fullwidthSlideShow'; //rota no site institucional

    public function __construct()
    {
        $this->repository   = new Module;
        $this->banners      = new Banners;
        $this->usuario      = $this->getSession();
    }

    public function index(array $params = null)
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-modules', 'title' => 'Modulos'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Slide Show FullWidth', 'active' => true];
        $dados['title']             = 'Slide Show Full Width';
        $dados["toptitle"]          = 'Slide Show Full Width';
        $dados['actionadd']         = $this->route . 'add';
        $dados['back']              = URL_BASE . 'admin-catalog-modules';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['tablelist']         = $this->load()->controller('admin-components-tablelistmodules', [
            [
                'lista'         => $this->repository->find('module_code =:module_code', "module_code={$this->module_code}")->fetch(true)
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
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-modules-fullwidthSlideShow', 'title' => 'Slide Show FullWidth'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Novo slide', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             =  'Novo Slide';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['form']              = $this->form();
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
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-modules-fullwidthSlideShow', 'title' => 'Slide Show FullWidth'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Editar slide', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             = 'Novo Slide';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['form']              = $this->form('update', 'Editar', $item);
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
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-modules-fullwidthSlideShow', 'title' => 'Slide Show FullWidth'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Remover slide', 'active' => true];
        $dados['back']              =  $this->route;
        $dados['title']             = 'Novo Slide';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $dados['form']              = $this->form('delete', 'Apagar', $item);
        $view                       = 'adm/pages/catalog/modules/default/add';
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request = $_POST;
        $request = filterpost($request);
        $slide = $this->repository;
        $slide->description = $request['description'];
        $slide->enable      = $request['enable'];
        $slide->module_code = $this->module_code;
        $slide->settings    = module_settings($request);

        $slideId            = $slide->save();
        if ($slideId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item criado com sucesso']);
            redirect($this->route);
        };
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
        $form           = new FormWrapper(new Form('formslidefullwidth'));

        $description    = new Entry('description', $action == 'delete' ? false : true);
        $inputbanner    = new Combo('banner', $action == 'delete' ? false : true);
        $banners        = $this->banners->find("enable=:enable", "enable=S")->fetch(true);

        $b['n'] = 'Selecione uma opção';
        foreach ($banners as $bannerselect)
            $b[$bannerselect->id] = $bannerselect->description;

        $inputbanner->addItems($b);
        $enable = new Combo('enable', $action == 'delete' ? false : true);
        $enable->addItems(['S' => 'Ativo',  'N' => 'Inativo']);

        $form->addField($description,   ['label' => 'Descrição *', 'css' => 'mb-4']);
        $form->addField($inputbanner,   ['label' => 'Banner *', 'css' => 'mb-4']);
        $form->addField($enable,        ['label' => 'Situcação *', 'css' => 'mb-4']);

        if ($data) {
            $form->addAction($buttonlabel, (object)['css' => 'btn btn-success', 'route' => $this->route . $action . '/' . $data->id, 'submit' => true]);
            $form->setData(dataModule($data));
        } else {
            $form->addAction($buttonlabel, (object)['css' => 'btn btn-success', 'route' => $this->route . $action, 'submit' => true]);
        }
        return  $form->getForm();
    }
}
