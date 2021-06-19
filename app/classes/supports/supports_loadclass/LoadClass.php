<?php

namespace app\classes\supports\supports_loadclass;

class LoadClass
{
    private $route;
    private $controller;
    private $parametros;

    public function controller(string $class, $parametros = [], string $metodo = 'get')
    {
        $this->metodo       = $metodo;
        $this->parametros   = $parametros;

        if (strpos($class, '-') == true) { //verifica se o controller está em algum diretório dentro da pasta controllers
            $class = explode('-', $class);
            for ($i = 0; $i < sizeof($class); $i++) {
                ($i < (sizeof($class) - 1)) ? $this->route .= $class[$i] . '\\' : $this->controller = $this->route . ucfirst($class[$i]) . "Controller";
            }
        } else {
            $this->controller = ucfirst($class) . "Controller";
        }

        if (class_exists(NAMESPACE_CONTROLLER . $this->controller)) {
            $this->controller = NAMESPACE_CONTROLLER . $this->controller;
            if (method_exists($this->controller, $this->metodo)) {
                $controller = new $this->controller;
                return call_user_func_array(array($controller, $this->metodo), $this->parametros);
            }
        }
    }
}
