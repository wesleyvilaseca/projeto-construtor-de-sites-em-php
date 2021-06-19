<?php

namespace app\controllers\admin\components;

use app\core\Controller;

class TablelistLayoutModulesController extends Controller
{
    
    public function get($params = null)
    {  
        $dados['modules']           = @$params['list'];
        $dados['editroute']         = @$params['editroute'];
        $dados['deleteroute']       = @$params['deleteroute'];
        $view                       = "adm/components/tablelist_layoutmodules";
        return $this->loadView($view, $dados);
    }

}
