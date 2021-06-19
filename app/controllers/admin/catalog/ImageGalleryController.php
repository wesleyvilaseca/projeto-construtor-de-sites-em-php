<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\Hidden;
use app\classes\widgets\form\ImputFile;
use app\classes\widgets\form\Number;
use app\classes\widgets\form\Text;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Banners;
use app\models\Imagegallery;
use app\request\admin\catalog\ImageGalleryRequest;

class ImageGalleryController extends Controller
{
    private $usuario;
    private $repository;
    private $banner;
    private $request;
    private $route = URL_BASE . 'admin-catalog-imageGallery/';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->repository   = new Imagegallery;
        $this->banner       = new Banners;
        $this->request      = new ImageGalleryRequest;
    }

    public function index(string $id = null)
    {
        if (!$id)
            redirectBack();

        $banner = $this->banner->findById($id);

        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-banners', 'title' => 'Banners'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Galeria de imagens ' . $banner->description, 'active' => true];
        $dados['title']             = 'Galeria de imagens ' . $banner->description;
        $dados["toptitle"]          = 'Galeria de imagens ' . $banner->description;
        $dados['back']              = URL_BASE . 'admin-catalog-banners';
        $dados['addroute']          = $this->route . 'add/' . $id . '/';
        $dados['editroute']         = $this->route . 'edit/' . $id . '/';
        $dados['deleteroute']       = $this->route . 'remove/' . $id . '/';
        $dados['images']            = $this->repository->find("banner_id=:id", "id={$id}")->fetch(true);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/imagegallery/index";
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
        $dados['breadcrumb'][]      = ['route' => $this->route . 'index/' . $idbanner, 'title' => 'Imagens galeria ' . $banner->description];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' =>  'Nova Imagem ' . $banner->description, 'active' => true];
        $dados['title']             = 'Nova Imagem ' . $banner->description;
        $dados["toptitle"]          = 'Nova Imagem ' . $banner->description;
        $dados['back']              = $this->route . 'index/' . $idbanner;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form($idbanner, 'save', 'Salvar', @getdataform());
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/imagegallery/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route . 'index/' . $idbanner, 'title' => 'Imagens galeria ' . $banner->description];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' =>  'Editar imagem', 'active' => true];
        $dados['back']              =  $this->route . 'index/' . $idbanner;
        $dados['title']             = 'Editar Imagem';
        $dados["toptitle"]          = 'Editar Imagem';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-layout']);
        $dados['form']              = $this->form($idbanner, 'update', 'Editar', @getdataform() ? getdataform() : $imagem);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/layout/banners/imagegallery/add";
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

        $text = $request['text'];
        $request = filterpost($request);

        $request['text'] = $text;

        $image                  = $this->repository;
        $image->image           = $request['image'];
        $image->image_filter    = $request['image_filter'];
        $image->text            = $request['text'] ?: null;
        $image->tags            = $request['tags'] ?: null;
        $image->banner_id       = $request['banner_id'];
        $imgeId                 = $image->save();
        if ($imgeId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item criado com sucesso']);
            redirect($this->route . 'index/' . $request['banner_id']);
        } else {
            setmessage(['tipo' => 'danger', 'msg' => 'Houve um erro na requisição']);
            redirect($this->route . 'index/' . $request['banner_id']);
        }
    }

    public function update(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item)
            redirectBack();

        $request            = $this->request->update($_POST);

        $text               = $request['text'];
        $request            = filterpost($request);
        $request['text']    = $text;

        $item->image        = $request['image'];
        $item->image_filter = $request['image_filter'];
        $item->text         = $request['text'] ?: null;
        $item->tags         = $request['tags'] ?: null;
        $item->banner_id    = $request['banner_id'];

        $itemId            = $item->save();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Item editado com sucesso']);
            redirect($this->route . 'index/' . $request['banner_id']);
        } else {
            setmessage(['tipo' => 'danger', 'msg' => 'Houve um erro na requisição']);
            redirect($this->route . 'index/' . $request['banner_id']);
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
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/' . $request['banner_id']);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect(URL_BASE . 'admin-catalog-bannerImage/index/' . $request['banner_id']);
        }
    }

    private function form(string $idbanner, string $action = 'save', string $buttonlabel = "Salvar", $data = null)
    {
        $editable = $action == 'delete' ? false :  true;

        $form           = new FormWrapper(new Form('formimage'), $action);
        $image          = new ImputFile('image', $editable);
        $filter         = new Entry('image_filter', $editable);
        $text           = new Text('text', $editable);
        $tags           = new Entry('tags', $editable);
        $bannerid       = new Hidden('banner_id');

        $bannerid->setProperty('value', $idbanner);

        $form->addField($image,         ['Imagem' => 'Titulo *', 'css' => 'mb-4']);
        $form->addField($filter,        ['label' => 'Filtro *', 'css' => 'mb-4']);
        $form->addField($text,          ['label' => 'Texto', 'css' => 'mb-4', 'editor' => true]);
        $form->addField($tags,          ['label' => 'Tags (em caso de mais de 1, separa por hifen - )', 'css' => 'mb-4']);
        $form->addField($bannerid, []);

        if ($data) {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => URL_BASE . 'admin-catalog-imageGallery/' . $action . '/' . @$data->id]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['submit' => true, 'css' => 'btn btn-success', 'route' => URL_BASE . 'admin-catalog-imageGallery/' . $action]);
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
