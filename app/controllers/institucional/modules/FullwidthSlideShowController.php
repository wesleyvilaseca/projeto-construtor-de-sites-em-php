<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\BannerImage;

class FullwidthSlideShowController extends Controller
{
    private $banners;
    private $slides;

    public function __construct()
    {
        $this->banners = new BannerImage;
    }

    public function get($params = null)
    {
        if ($params) $this->setslide($params);

        $dados['slide']             = $this->slides;
        $view                       = "institucional/modules/slidesection";
        return $this->loadView($view, $dados);
    }

    private function setslide(object $params): void
    {
        $settings = json_decode($params->settings);
        if (@$settings->banner)
            $images = $this->banners->find("banner_id=:id", "id={$settings->banner}")->order("sort_order ASC")->fetch(true);

        if ($images) {
            $this->slides['conteudo']  = $images;
            $this->slides['id']        = 'slide' . rand();
        }
    }
}
