<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\Imagegallery;

class ImagegalleryController extends Controller
{
    private $settings;
    private $filters;
    private $gallery;
    private $idgallery;

    public function __construct()
    {
        $this->gallery = new Imagegallery;
        $this->idgallery = 'gallery' . rand();
    }

    public function get($params = null)
    {
        if ($params) $this->setSettings($params);

        //dd($this->settings['images']);

        $dados['title']             = @$this->settings['title'];
        $dados['subtitle']          = @$this->settings['subtitle'];
        $dados['images']            = $this->settings['images'];
        $dados['idgallery']         = $this->idgallery;
        $dados['filters']           = $this->filters;
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/imagegalery";
        return $this->loadView($view, $dados);
    }

    private function setSettings($params)
    {
        $settings = json_decode($params->settings);
        $this->settings['title']    = @$settings->title;
        $this->settings['subtitle']  = @$settings->subtitle;

        $images = $this->gallery->find("banner_id=:id", "id={$settings->banner}")->fetch(true);
        foreach ($images as $image) {
            $tags = explode('-', $image->tags);
            $this->setFilter($tags);
        }
        $this->settings['images'] = $images;
    }

    private function setFilter($tags)
    {
        foreach ($tags as $tag) {
            if (isset($this->filters)) {
                if (in_array($tag, $this->filters) !== true) $this->filters[] = $tag;
            } else {
                $this->filters[] = $tag;
            }
        }
    }

    private function js()
    {
        $js = $this->magnificPopUp();
        return $js;
    }
}
