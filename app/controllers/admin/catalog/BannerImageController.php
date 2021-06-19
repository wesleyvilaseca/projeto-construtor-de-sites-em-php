<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\Hidden;
use app\classes\widgets\form\ImputFile;
use app\classes\widgets\form\Number;
use app\classes\widgets\form\Text;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\BannerImage;
use app\models\Banners;
use app\request\admin\catalog\BannerImageRequest;

//use app\models\Home;

class BannerImageController extends Controller
{
    private $usuario;
    private $repository;
    private $banner;
    private $request;

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->repository   = new BannerImage;
        $this->banner       = new Banners;
        $this->request      = new BannerImageRequest;
    }

    public function index(string $id = null)
    {
        if (!$id)
            redirectBack();

        $banner = $this->banner->findById($id);

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-banners', 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-bannerImage/' . $id, 'title' => 'Imagens banner ' . $banner->description, 'active' => true];
        $dados['title']             = 'Imagens banner ' . $banner->description;
        $dados["toptitle"]          = 'Imagens banner ' . $banner->description;
        $dados['back']              = URL_BASE . 'admin-catalog-banners';
        $dados['addroute']          = URL_BASE . 'admin-catalog-bannerImage/add/' . $id . '/';
        $dados['editroute']         = URL_BASE . 'admin-catalog-bannerImage/edit/' . $id . '/';
        $dados['deleteroute']       = URL_BASE . 'admin-catalog-bannerImage/remove/' . $id . '/';
        $dados['images']            = $this->repository->find("banner_id=:id", "id={$id}")->fetch(true);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/bannerimage/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add(string $idbanner = null)
    {
        if (!$idbanner)
            redirectBack();

        $banner = $this->banner->findById($idbanner);

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-banners', 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-bannerImage/index/' . $idbanner, 'title' => 'Imagens banner ' . $banner->description];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-bannerImage/add/' . $idbanner, 'title' =>  'Nova Imagem Banner ' . $banner->description, 'active' => true];
        $dados['title']             = 'Nova Imagem Banner ' . $banner->description;
        $dados["toptitle"]          = 'Nova Imagem Banner ' . $banner->description;
        $dados['back']              = URL_BASE . 'admin-catalog-bannerImage/index/' . $idbanner;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form($idbanner, 'save', 'Salvar', @getdataform());
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/bannerimage/add";
        $this->renderView($view, $dados);
    }

    public function edit(string $idbanner = null, string $idimage = null)
    {
        if (!$idbanner || !$idimage)
            redirectBack();

        $banner = $this->banner->findById($idbanner);
        $imagem = $this->repository->findById($idimage);

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-banners', 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-bannerImage/index/' . $idbanner, 'title' => 'Imagens banner ' . $banner->description];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-bannerImage/edit/' . $idbanner . '/' . $idimage, 'title' =>  'Editar imagem' . $imagem->title, 'active' => true];
        $dados['back']              =  URL_BASE . 'admin-catalog-bannerImage/index/' . $idbanner;
        $dados['title']             = 'Editar Imagem ' . $imagem->title;
        $dados["toptitle"]          = 'Editar Imagem ' . $imagem->title;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form($idbanner, 'update', 'Editar', @getdataform() ? getdataform() : $imagem);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/bannerimage/add";
        $this->renderView($view, $dados);
    }

    public function remove(string $idbanner = null, string $idimage = null)
    {
        if (!$idbanner || !$idimage)
            redirectBack();

        $banner = $this->banner->findById($idbanner);
        $imagem = $this->repository->findById($idimage);

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-banners', 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-bannerImage/index/' . $idbanner, 'title' => 'Imagens banner ' . $banner->description];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-bannerImage/edit/' . $idbanner . '/' . $idimage, 'title' =>  'Remover imagem' . $imagem->title, 'active' => true];
        $dados['back']              =  URL_BASE . 'admin-catalog-bannerImage/index/' . $idbanner;
        $dados['title']             = 'Remover Imagem ' . $imagem->title;
        $dados["toptitle"]          = 'Remover Imagem ' . $imagem->title;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form($idbanner, 'delete', 'Remover', @getdataform() ? getdataform() : $imagem);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/bannerimage/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request = $this->request->save($_POST);
        $description = $request['description'];
        $request = filterpost($request);
        $request['description'] = $description;

        $image = $this->repository;
        $image->title       = $request['title'];
        $image->link        = @$request['link'];
        $image->image       = $request['image'];
        $image->description = @$request['description'];
        $image->sort_order  = @$request['sort_order'];
        $image->banner_id   = $request['banner_id'];
        $imgeId             = $image->save();
        if ($imgeId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item criado com sucesso']);
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/' . $request['banner_id']);
        } else {
            setmessage(['tipo' => 'danger', 'msg' => 'Houve um erro na requisição']);
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/' . $request['banner_id']);
        }
    }

    public function update(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $request        = $this->request->save($_POST, $id);
        $description    = $request['description'];
        $request        = filterpost($request);
        $request['description'] = $description;

        $item->title       = $request['title'];
        $item->link        = @$request['link'];
        $item->image       = $request['image'];
        $item->description = @$request['description'];
        $item->sort_order  = @$request['sort_order'];
        $item->banner_id   = $request['banner_id'];
        $itemId            = $item->save();
        $itemId = $item->save();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item editado com sucesso']);
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/' . $request['banner_id']);
        } else {
            setmessage(['tipo' => 'danger', 'msg' => 'Houve um erro na requisição']);
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/' . $request['banner_id']);
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
            setmessage(['tipo' => 'success', 'msg' => 'Item removido com sucesso']);
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/'. $request['banner_id']);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/'. $request['banner_id']);
        }
    }

    private function form(string $idbanner, string $action = 'save', string $buttonlabel = "Salvar", $data = null)
    {
        $editable       = $action == 'delete' ? false :  true;
        $form           = new FormWrapper(new Form('formimage'));
        $title          = new Entry('title', $editable);
        $link           = new Entry('link', $editable);
        $image          = new ImputFile('image', $editable);
        $description    = new Text('description', $editable);
        $order          = new Number('sort_order', $editable);
        $bannerid       = new Hidden('banner_id');
        $bannerid->setProperty('value', $idbanner);

        $form->addField($title,         ['label' => 'Titulo *','css' => 'mb-4']);
        $form->addField($link,          ['label' => 'link','css' => 'mb-4']);
        $form->addField($image,         ['label' => 'Imagem','css' => 'mb-4']);
        $form->addField($description,   ['label' => 'Descrição','css' => 'mb-4','editor' => true]);
        $form->addField($order,         ['label' => 'Ordem','css' => 'mb-4']);
        $form->addField($bannerid, []);

        if ($data) {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => URL_BASE . 'admin-catalog-bannerImage/' . $action . '/' . @$data->id]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['submit' => true , 'css' => 'btn btn-success', 'route' => URL_BASE . 'admin-catalog-bannerImage/' . $action]);
        }
        return  $form->getForm();
    }

    private function js()
    {
        $js = $this->jquery();
        $js .= $this->bootstrapjs();
        $js .= $this->fancybox_js();
        $js .= $this->tinyEditorActive();
        return $js;
    }
}
