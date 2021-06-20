<?php

namespace app\controllers\admin\components;

use app\core\Controller;

class TablelistmodulesController extends Controller
{
    
    public function get($params = null)
    {   
        $dados['itens']             = @$params['lista'];
        $dados['action']            = @$params['actionroute'];
        $view                       = "adm/components/tablelistmodules";
        return $this->loadView($view, $dados);
    }

}
