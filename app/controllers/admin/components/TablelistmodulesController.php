<?php

namespace app\controllers\admin\components;

use app\core\Controller;

class TablelistmodulesController extends Controller
{
    
    public function get($params = null)
    {   
        $dados['itens']             = $params['lista'];
        $view                       = "adm/components/tablelistmodules";
        return $this->loadView($view, $dados);
    }

}
