<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\BannerImage;

class StaticcardsController extends Controller
{
    private $settings;
    private $banners;

    public function __construct()
    {
        $this->banners = new BannerImage;
    }

    public function get($params = null)
    {
        if ($params) $this->setSettings($params);

        $dados['title']             = @$this->settings['title'];
        $dados['subtitle']          = @$this->settings['subtitle'];
        $dados['cards']             = $this->settings['cards'];
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/staticcardssection";
        return $this->loadView($view, $dados);
    }

    private function setSettings($params)
    {
        $settings = json_decode($params->settings);
        $this->settings['title']       = @$settings->title;
        $this->settings['subtitle']    = @$settings->subtitle;

        if (@$settings->banner)
            $cards = $this->banners->find("banner_id=:id", "id={$settings->banner}")->order("sort_order ASC")->fetch(true);

        $this->settings['cards'] = $cards;
    }

    private function js()
    {
        $js = $this->isotope();
        return $js;
    }
}
