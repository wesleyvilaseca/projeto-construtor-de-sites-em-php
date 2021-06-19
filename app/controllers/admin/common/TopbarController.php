<?php

namespace app\controllers\admin\common;

use app\core\Controller;

class TopbarController extends Controller
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = $this->getSession();
    }

    public function get()
    {
        $dados['usuario']           = $this->usuario;
        $view                       = "adm/template/topbar";
        return $this->loadView($view, $dados);
    }
}
