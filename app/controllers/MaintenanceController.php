<?php
namespace app\controllers;
use app\core\Controller;

class MaintenanceController extends Controller
{
    public function index()
    {
        dd("Em manutenção");
        $dados          = [];
        $view           = "principal/pages/maintenance/index";
        $this->load($view, $dados);
    }
}
