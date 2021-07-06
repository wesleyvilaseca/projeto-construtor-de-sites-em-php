<?php

/**
 * a Doc é meio capitão óbvio (para não leigos), mas pode ser que ajude
 * 
 * by Wesley Vila Seca
 */

class Core
{
    private $controller;
    private $metodo;
    private $parametros = array();
    private $route;

    public function __construct()
    {
        $this->verificaUri();
    }

    public function run()
    {
        /**
         * no call user eu passo um array, onde primeiro vai o objeto, em seguida eu passo o método
         * e após isso eu passo os parêmetros que o método em questão vai receber
         * 
         */
        $currentController  = $this->getController();
        $c                  = new $currentController();
        call_user_func_array(array($c, $this->getMethod()), $this->getParam());
    }

    public function verificaUri()
    {
        /**
         * o metodo run vai ser o responsável por administrar o controller que vai ser executado
         * 
         * $url = explode("index.php", $_SERVER["PHP_SELF"]); -> local
         * $url = explode("index.php", $_SERVER["REQUEST_URI"]); -> local
         * 
         * Depois de verificado, se o site se encontra em manutenção, é feito um tratamento na string capturada
         * com ela extraio a string apos a urlbase, para identificar o controller
         * em seguida extrai o metodo dentro do controller 
         * e depois extrai os parametros
         */

        if (EM_MANUTENCAO) {
            $this->controller = 'MaintenanceController';
        } else {
            $url = explode("index.php", $_SERVER["PHP_SELF"]);
            $url = end($url);
            if ($url != "") {
                $url = explode('/', $url);
                array_shift($url);
                $this->setController($url);

                array_shift($url);
                if (isset($url[0])) $this->setMethod($url);

                array_shift($url);
                if (isset($url[0])) $this->setParam($url);

            } else {
                $this->setDefaultController();
            }
        }
    }

    private function setController($url)
    {
        /**
         * com a url em mãos, é verificado, se o controller se encontra em algum diretório. O caminho para o diretorio, é feito com os hifens '-'
         * 
         * caso não tenha hifen, é vericado, se as string capturada, é algum controller pré definido, se não, segue o fluxo
         */
        if (strpos($url[0], '-') == true) {
            $route = explode('-', $url[0]);
            for ($i = 0; $i < sizeof($route); $i++) {
                ($i < (sizeof($route) - 1)) ? $this->route .= $route[$i] . '\\' : $this->controller = $this->route . ucfirst($route[$i]) . "Controller";
            }
        } else {
            $controller = ucfirst($url[0]);
            switch ($controller) {
                case "Page":
                    $controller = 'institucional\\common\\Page';
                    $this->controller = $controller . "Controller";
                    break;
                default:
                    $this->controller = $controller . "Controller";
                    break;
            }
        }
    }

    private function setDefaultController()
    {
        if (strpos(CONTROLLER_PADRAO, '\\') == true) {
            $route = explode('\\', CONTROLLER_PADRAO);
            for ($i = 0; $i < sizeof($route); $i++) {
                ($i < (sizeof($route) - 1)) ? $this->route .= $route[$i] . '\\' : $this->controller = $this->route . ucfirst($route[$i]) . "Controller";
            }
        } else {
            $this->controller = ucfirst(CONTROLLER_PADRAO) . "Controller";
        }
    }

    private function setMethod($url)
    {
        $this->metodo = $url[0];
        array_shift($url); 
    }

    private function setParam($url){
        $this->parametros = array_filter($url); 
    }

    private function getController()
    {
        if (class_exists(NAMESPACE_CONTROLLER . $this->controller)) {
            return NAMESPACE_CONTROLLER . $this->controller;
        }
        return NAMESPACE_CONTROLLER . ucfirst(CONTROLLER_PADRAO) . "Controller";
    }

    private function getMethod()
    {
        //verifica se existe metodo dentro da classe do objeto
        if (method_exists(Core::getController(), $this->metodo)) {
            return $this->metodo;
        }

        return METODO_PADRAO;
    }

    private function getParam()
    {
        return $this->parametros;
    }
}
