<?php

namespace app\controllers\admin\catalog;

use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\ImputFile;
use app\classes\widgets\form\Text;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\Banners;
use app\models\Blogarticle;
use app\models\Blogcategory;
use CoffeeCode\Paginator\Paginator;

class BlogarticleController extends Controller
{
    private $repository;
    private $categories;
    private $paginator;
    private $page;
    private $imagegallery;
    private $route = URL_BASE . 'admin-catalog-blogarticle/';

    public function __construct()
    {
        $this->page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);
        $this->imagegallery = new Banners;
        $this->categories   = new Blogcategory;
        $this->repository   = new Blogarticle;
        $this->usuario      = $this->getSession();
        $this->paginator    = new Paginator($this->route . '?page=', "Página", ["Primeira página", "Primeira"], ["Última página", "Última"]);
        $this->paginator->pager($this->repository->find()->count(), 5, $this->page, 2);
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Artigos', 'active' => true];
        $dados['title']             = 'Artigos';
        $dados["toptitle"]          = 'Artigos';
        $dados['addroute']          = $this->route . 'add';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['deleteroute']       = $this->route . 'remove/';
        $dados['articles']          = $this->repository->find()->limit($this->paginator->limit())->offset($this->paginator->offset())->fetch(true);
        $dados['paginator']         = $this->paginator->render();
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['page']              = $this->page;
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/article/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function search(string $search = null)
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Artigos', 'active' => true];
        $dados['title']             = 'Artigos';
        $dados["toptitle"]          = 'Artigos';
        $dados['addroute']          = $this->route . 'add';
        $dados['editroute']         = $this->route . 'edit/';
        $dados['deleteroute']       = $this->route . 'remove/';
        $dados['articles']          = $this->repository->find()->fetch(true);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/article/index";
        $this->renderView($view, $dados);
        destroydataform();
    }

    public function add()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Artigos', 'active' => true];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Novo artigo', 'active' => true];
        $dados['title']             = 'Novo artigo';
        $dados["toptitle"]          = 'Novo artigo';
        $dados["back"]              = $this->route;
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['form']              = $this->form();
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/article/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Artigos', 'active' => true];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Editar artigo', 'active' => true];
        $dados['title']             = 'Editar artigo ' . $item->title;
        $dados["toptitle"]          = 'Editar artigo ' . $item->title;
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('update', 'Editar', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['page']              = $this->page;
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/article/add";
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
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Blog / Artigos', 'active' => true];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Remover artigo', 'active' => true];
        $dados['title']             = 'remover artigo ' . $item->title;
        $dados["toptitle"]          = 'remover artigo ' . $item->title;
        $dados["back"]              = $this->route;
        $dados['form']              = $this->form('delete', 'Remover', @getdataform() ?: $item);
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-blog']);
        $dados['page']              = $this->page;
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/blog/article/add";
        $this->renderView($view, $dados);
    }

    public function save()
    {
        $request                    = $_POST;
        $text                       = $request['article'];
        $request                    = filterpost($request);
        $request['article']         = $text;

        if (!$request['title'] || !$request['seo'] || !$request['description'] || !$request['article']) {
            setdataform($request);
            setmessage(['tipo' => 'warning', 'msg' => 'Os campos com * são de preenchimento obrigatório!']);
            return redirectBack();
        }

        $article                        = $this->repository;
        $article->thumb                 = $request['thumb'];
        $article->title                 = $request['title'];
        $article->seo                   = $request['seo'];
        $article->description           = $request['description'];
        $article->blog_category_id      = $request['blog_category_id'];
        $article->article               = $request['article'] ?: '';
        $article->image_gallery_id      = $request['image_gallery_id'] ?: '';
        $article->enable                = $request['enable'] ?: 'S';

        $articleId                      = $article->save();
        if ($articleId) {
            setdataform($request);
            setmessage(['tipo' => 'success', 'msg' => 'Artigo criado com sucesso']);
            redirect($this->route);
        }
    }

    public function update(string $id)
    {
        if (!$id) redirect($this->route);

        $item = $this->repository->findById($id);
        if (!$item) redirect($this->route);

        $page = $this->page ? '?page=' . $this->page : null;


        $request                    = $_POST;
        if (!$request['title'] || !$request['seo'] || !$request['description'] || !$request['article']) {
            $request['id'] = $id;
            setdataform($request);
            setmessage(['tipo' => 'warning', 'msg' => 'Os campos com * são de preenchimento obrigatório!']);
            return redirectBack();
        }

        $text                       = $request['article'];
        $request                    = filterpost($request);
        $request['article']         = $text;

        $item->thumb                = $request['thumb'];
        $item->title                = $request['title'];
        $item->seo                  = $request['seo'];
        $item->description          = $request['description'];
        $item->blog_category_id     = $request['blog_category_id'];
        $item->article              = $request['article'] ?: '';
        $item->image_gallery_id     = $request['image_gallery_id'] ?: '';
        $item->enable               = $request['enable'] ?: 'S';

        $itemId                      = $item->save();
        if ($itemId) {
            setdataform($request);
            setmessage(['tipo' => 'success', 'msg' => 'Artigo editado com sucesso']);
            redirect($this->route .  $page);
        }
    }

    public function delete(string $id)
    {
        $item = $this->repository->findById($id);
        if (!$item) redirectBack();

        $page = $this->page ? '?page=' . $this->page : null;

        $request    = $_POST;
        if (isset($request))
            $request = filterpost($request);

        $itemId = $item->destroy();
        if ($itemId) {
            setmessage(['tipo' => 'success', 'msg' => 'Artigo removida com sucesso']);
            redirect($this->route . $page);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route . $page);
        }
    }


    private function form(string $action = 'save', string $buttonlabel = "Salvar", object $data = null)
    {
        $page = $this->page ? '?page=' . $this->page : null;
        $form = new FormWrapper(new Form('articles'));
        $form->setActionInBottom(true);

        $editable = $action == 'delete' ? false :  true;

        $thumb          = new ImputFile('thumb', $editable);
        $title          = new Entry('title', $editable);
        $title->setProperty('onfocusout', "blog.methods.seo(value)");

        $seo            = new Entry('seo', $editable);
        $seo->setProperty('id', 'seo');
        $description    = new Text('description', $editable);
        $category_id    = new Combo('blog_category_id', $editable);

        $category_id->addItems($this->categories->getCategoryInArray());

        $article    = new Text('article', $editable);

        $image_gallery_id = new Combo('image_gallery_id', $editable);
        $image_gallery_id->addItems($this->imagegallery->imageGalleryList());
        $enable = new Combo('enable', $editable);
        $enable->addItems([
            'S' => 'Ativo',
            'N' => 'Inativo'
        ]);
        $form->addField($thumb,             ['label' => 'Thumb *', 'css' => 'mb-4']);
        $form->addField($title,             ['label' => 'Titulo *', 'css' => 'mb-4']);
        $form->addField($seo,               ['label' => 'SEO *', 'css' => 'mb-4']);
        $form->addField($description,       ['label' => 'Descrição *', 'css' => 'mb-4']);
        $form->addField($category_id,       ['label' => 'Categoria *', 'css' => 'mb-4']);
        $form->addField($article,           ['label' => 'Artigo', 'css' => 'mb-4', 'editor' => true]);
        $form->addField($image_gallery_id,  ['label' => 'Associar uma galeria de imagens a esse artigo?', 'css' => 'mb-4']);
        $form->addField($enable,            ['label' => 'Situação', 'css' => 'mb-4']);

        if ($data) {
            $form->addAction($buttonlabel,  (object)['css' => 'btn btn-success', 'route' => $this->route . $action . '/' . @$data->id . $page, 'submit' => true]);
            $form->setData($data);
        } else {
            $form->addAction($buttonlabel, (object)['css' => 'btn btn-success', 'route' => $this->route . $action . $page, 'submit' => true]);
        }
        return  $form->getForm();
    }

    private function js()
    {
        $js = $this->jquery();
        $js .= $this->bootstrapjs();
        $js .= $this->fancybox_js();
        $js .= $this->tinyEditorActive();
        $js .= '<script src="' . URL_BASE . 'assets/adm/js/catalog/blog/blog.js" type="text/javascript"></script>';
        return $js;
    }
}
