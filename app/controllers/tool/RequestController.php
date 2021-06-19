<?php

namespace app\controllers\tool;

use app\core\Controller;
use app\classes\body_api_create\Request;
use app\classes\body_api_create\Parametros;
use app\classes\body_api_create\Condicoes;

class RequestController extends Controller
{
    //modelo de montagem de corpo para requisição na api da delphos
    public function index()
    {
        $dados['x'] = $this->teste();
        //$dados['y'] = $this->teste2();
        $dados["view"] = "home/index";
        $this->load("index", $dados);
    }

    //teste funcional usando classes
    public function teste()
    {
        $request = new Request();
        /**
         * val é um objeto array multdimensional que irá compor o corpo do objeto repositório
         * ele precisa ser multdimensional. A estrutura objeto repositório que a api recebe, é composto por diversos arrays multidimensional
         */
        $val = (object) array();
        $val->nome = 'bairro';
        $val->metodo = 'add';

        $request->setToken('blablablabal não dormi blablabal');//caso tenha token, deve ser setado.

        //aqui é o escopo de cada requisição dentro do data. indice é a tabela, os parametros são as requisições para cada indice
        $val->indice[] = 'teste';
        $parametros1 = new Parametros;
        //as setagem de parametros abaixo corresponde a quantidade de indices por parâmetro
        $parametros1->setParam('id', 'cidade', 'int');
        $parametros1->setParam('id', 'cidade2', 'int');
        $val->param[] = [$parametros1->getParam(), $parametros1->getParam(), $parametros1->getParam()];//aqui é onde é setado a quantidade de parâmentros por indice
        
        $val->indice[] = 'teste2';
        $parametros2 = new Parametros;
        $parametros2->setParam('id', 'bairro', 'int');
        $parametros2->setParam('id', 'bairro2', 'int');
        $val->param[] = [$parametros1->getParam(), $parametros2->getParam()];

        $condicoes = new Condicoes;
        $condicoes->setCondicoes('cep', '68459370', 'string');
        $condicoes->setCondicoes('cep2', '68459370', 'string');
        //$request->setCondicoes($condicoes->getCondicoes());

        $request->setRepositorio($val);

        return $request->toJson();

        
    }


    //teste funcional, sem usar classes
    public function teste2()
    {

        $val = (object) array();
        $val->indice[] = 'teste';
        $val->indice[] = 'teste2';

        $parametros1 = new Parametros;
        $parametros1->setParam('id', 'cidade', 'int');
        $parametros1->setParam('id', 'cidade2', 'int');
        $val->param[] = [$parametros1->getParam()];


        $parametros2 = new Parametros;
        $parametros2->setParam('id', 'bairro', 'int');
        $parametros2->setParam('id', 'bairro2', 'int');
        $val->param[] = [$parametros1->getParam(), $parametros2->getParam()];

        $x = (object) [
            'token' => '',
            'repositorio' => (object) [
                'nome'      => '',
                'metodo'    => '',
                'group'     => '',
                'order'     => '',
                'limit'     => '',
                'atributos' => '',
                'data'      => $this->montaData($val)
            ],
            'condicoes' => array(),
        ];

        return $x;
    }

    /*public function montadata($val)
    {
        $data = new DataSet();
        $z = array();
        for ($i = 0; $i < count($val->indice); $i++) {
            $data->setDataset($val->param[$i]);
            $z = $z + [
                $val->indice[$i] => [
                    'dataset' => $data->getDataset()[$i]
                ]
            ];
        }

        return $z;
    }*/

    public function montadata($val)
    {
        $z = array();
        for ($i = 0; $i < count($val->indice); $i++) {
            $z = $z + [
                $val->indice[$i] => [
                    'dataset' => $this->dataSets($val->param[$i])
                ]
            ];
        }

        return $z;
    }

    public function dataSets($val)
    {
        $i = 0;
        while ($i < count($val)) {
            //$a = array();
            $b = array();
            foreach ($val as $v) {
                $a = ['parametros' => $v];
                $b[] = $a;
            }
            return $b;
            $i++;
        }
    }
}
