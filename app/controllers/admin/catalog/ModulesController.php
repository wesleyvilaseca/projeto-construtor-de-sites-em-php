<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\Modules;

//use app\models\Home;

class ModulesController extends Controller
{
    private $usuario;
    private $repository;
    private $route = URL_BASE . 'admin-catalog-modules/';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->repository   = new Modules;
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-adm', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => $this->route, 'title' => 'Modulos', 'active' => true];
        $dados['title']             = 'Modulos ';
        $dados["toptitle"]          = 'Modulos';
        $dados['modules']           = $this->repository->find()->fetch(true);
        $dados['js']                = $this->js();
        $dados['actionEnable']      = $this->route . 'enableModule/';
        $dados['actionDisable']     = $this->route . 'disableModule/';
        $dados['topbar']            = $this->load()->controller('admin-common-topbar');
        $dados['sidemenu']          = $this->load()->controller('admin-common-sidemenu', ['admin-catalog-modules']);
        $view                       = "adm/pages/catalog/modules/index";
        $this->renderView($view, $dados);
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= '<script src="' . URL_BASE . 'assets/adm/js/catalog/modules/modules.js" type="text/javascript"></script>';
        return $js;
    }

    public function enableModule(string $id)
    {
        $module = $this->repository->findById($id);
        if (!$module)
            redirectBack();

        $module->enable = 'S';
        $saveId = $module->save();
        if ($saveId) {
            setmessage(['tipo' => 'success', 'msg' => 'Modulo ativado com sucesso']);
            redirect($this->route);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na requisição']);
            redirect($this->route);
        }
    }

    public function disableModule(string $id)
    {
        $module = $this->repository->findById($id);
        if (!$module)
            redirectBack();

        $module->enable = 'N';
        $saveId = $module->save();
        if ($saveId) {
            setmessage(['tipo' => 'success', 'msg' => 'Modulo desativado com sucesso']);
            redirect($this->route);
        } else {
            setmessage(['tipo' => 'warning', 'msg' => 'Ocorreu um erro na na requisição']);
            redirect($this->route);
        }
    }
}
