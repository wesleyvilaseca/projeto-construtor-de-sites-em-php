<?php

namespace app\controllers\institucional\blog;

use app\core\Controller;
use app\models\Blogarticle;
use app\models\Blogcategory;
use app\models\Blogconfig;
use app\models\Configsite;
use app\models\Imagegallery;
use app\models\Theme;
use CoffeeCode\Paginator\Paginator;

class BlogController extends Controller
{
    private $theme;
    private $html;
    private $blogconfig;
    private $articles;
    private $paginator;
    private $categories;
    private $route = URL_BASE . 'blog/';
    private $page;
    private $gallery;
    private $galleryFilters;

    public function __construct()
    {
        $this->page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRIPPED);
        $configsite         = new Configsite;
        $blogconfig         = new Blogconfig;
        $theme              = new Theme;
        $this->gallery      = new Imagegallery;
        $this->categories   = new Blogcategory;
        $this->articles     = new Blogarticle;
        $this->blogconfig   = $blogconfig->find()->fetch();
        $this->theme        = $theme->findById($configsite->find()->fetch()->theme_id);
        $this->paginator    = new Paginator($this->route . '?page=', "Página", ["Primeira página", "Primeira"], ["Última página", "Última"]);
    }

    public function index()
    {
        $dados['title']             = 'Blog';
        $dados['theme']             = $this->theme;
        $dados['sections']          = $this->html;
        $dados['categories']        = $this->categories->find()->fetch(true);
        $dados['header']            = $this->blogconfig->header == "S" ? $this->load()->controller('institucional-common-header', [['theme' => $this->theme]]) : '';
        $dados['footer']            = $this->blogconfig->footer == "S" ? $this->load()->controller('institucional-common-footer', [['theme' => $this->theme]]) : '';
        $dados['js']                = $this->js();

        $this->paginator->pager($this->articles->find()->count(), 5, @$this->page, 2);

        $dados['articles']          =  $this->articles->find()->limit($this->paginator->limit())->offset($this->paginator->offset())->fetch(true);
        $dados['paginator']         = $this->paginator->render();
        $dados['page']              = $this->page;
        $view                       = "institucional/pages/blog/index";
        $this->renderView($view, $dados);
    }

    public function categorysearch(string $id)
    {
        if (!$id) redirectBack();

        $dados['title']             = 'Blog';
        $dados['theme']             = $this->theme;
        $dados['sections']          = $this->html;
        $dados['categories']        = $this->categories->find()->fetch(true);
        $dados['header']            = $this->blogconfig->header == "S" ? $this->load()->controller('institucional-common-header', [['theme' => $this->theme]]) : '';
        $dados['footer']            = $this->blogconfig->footer == "S" ? $this->load()->controller('institucional-common-footer', [['theme' => $this->theme]]) : '';
        $dados['js']                = $this->js();


        $this->paginator->pager($this->articles->find("blog_category_id=:id", "id={$id}")->count(), 5, @$this->page, 2);

        $dados['articles']          = $this->articles->find("blog_category_id=:id", "id={$id}")->limit($this->paginator->limit())->offset($this->paginator->offset())->fetch(true);
        $dados['paginator']         = $this->paginator->render();
        $view                       = "institucional/pages/blog/index";
        $this->renderView($view, $dados);
    }

    public function article(string $seo)
    {
        $page = $this->page ? '?page=' . $this->page : null;

        if (!$seo) redirect($this->route . $page);

        $item = $this->articles->find("seo=:seo", "seo={$seo}")->fetch();
        if (!$item) redirect($this->route . $page);

        if ($item->image_gallery_id) {
            $dados["gallery"] = $this->getGallery($item->image_gallery_id);
        }

        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'blog' . $page, 'title' => 'Blog'];
        $dados['breadcrumb'][]      = ['route' => "#", 'title' => 'Artigo ' . $item->title, 'active' => true];
        $dados['theme']             = $this->theme;
        $dados['title']             = 'Blog ' . $item->title;
        $dados['categories']        = $this->categories->find()->fetch(true);
        $dados['article']           = $item;
        $dados['header']            = $this->blogconfig->header == "S" ? $this->load()->controller('institucional-common-header', [['theme' => $this->theme]]) : '';
        $dados['footer']            = $this->blogconfig->footer == "S" ? $this->load()->controller('institucional-common-footer', [['theme' => $this->theme]]) : '';
        $dados['js']                = $this->js();
        $view                       = "institucional/pages/blog/article";
        $this->renderView($view, $dados);
    }

    private function getGallery($id)
    {

        $images = $this->gallery->find("banner_id=:id", "id={$id}")->fetch(true);
        foreach ($images as $image) {
            $tags = explode('-', $image->tags);
            $this->gallerySetFilter($tags);
        }

        $dados['images']            = $images;
        $dados['idgallery']         = 'gallery' . rand();
        $dados['filters']           = $this->galleryFilters;
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/imagegalery";
        return $this->loadView($view, $dados);
    }

    private function gallerySetFilter($tags)
    {
        foreach ($tags as $tag) {
            if (isset($this->galleryFilters)) {
                if (in_array($tag, $this->galleryFilters) !== true) $this->galleryFilters[] = $tag;
            } else {
                $this->galleryFilters[] = $tag;
            }
        }
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->magnificPopUp();
        $js .= $this->carousel_js();
        $js .= $this->carousel_min_js();
        $js .= $this->isotope();
        return $js;
    }
}
