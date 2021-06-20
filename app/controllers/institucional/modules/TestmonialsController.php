<?php

namespace app\controllers\institucional\modules;

use app\core\Controller;
use app\models\BannerImage;

class TestmonialsController extends Controller
{
    private $settings;

    public function __construct()
    {
        $this->banners = new BannerImage;
    }

    public function get($params = null)
    {
        if ($params) $this->setSettings($params);

        $dados['title']             = @$this->settings['title'];
        $dados['comments']          = @$this->settings['comments'];
        $dados['js']                = $this->js();
        $view                       = "institucional/modules/testimonials";
        return $this->loadView($view, $dados);
    }

    private function setSettings($params)
    {
        $settings = json_decode($params->settings);
        $this->settings['title'] = $params->description;

        if (@$settings->banner)
            $comments = $this->banners->find("banner_id=:id", "id={$settings->banner}")->order("sort_order ASC")->fetch(true);

        $this->settings['comments'] = @$comments;
    }

    private function js()
    {
        $js = $this->carousel_js();
        $js .= $this->carousel_min_js();
        return $js;
    }
}
