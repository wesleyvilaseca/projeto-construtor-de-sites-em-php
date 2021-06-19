<?php

namespace app\core;

use app\classes\supports\supports_session\DataSession;
use app\classes\supports\supports_apirequest\PullApi;
use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use CoffeeCode\DataLayer\Connect;

abstract class Model
{
    protected $db;
    use DataSession;
    use Validation;
    use Cripto;

    public function __construct()
    {
        $this->db = Connect::getInstance();
        $error = Connect::getError();
        if($error){
            echo $error->getMessage();
            die();
        }
    }

    protected static function pullApi($param1, $url, $data = null, $headers = false)
    {
        $apiRequest = new PullApi;
        return $apiRequest->pullApi($param1, $url, $data, $headers);
    }
}
