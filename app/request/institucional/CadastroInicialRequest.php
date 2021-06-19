<?php

namespace app\request\principal;

use app\classes\supports\supports_validation\Validation;

class CadastroInicialRequest
{
    use Validation;

    public function cadastroInicial(object $val)
    {
        $tab1 = ['razao_proprietario', 'fantasia_estabelecimento', 'cnpj', 'atividades'];
        $tab2 = ['endcep', 'endnumero', 'endlogradouro'];
        $tab4 = ['nome', 'senha', 'cpf', 'conf_senha', 'login_email', 'login_cel'];

        foreach ($val as $key1 => $input) {
            foreach ($tab1 as $tab) {
                if ($key1 == $tab) {
                    if (!$input) {
                        $data['mensagem']   = "Peencha os campos obrigatórios!";
                        $data['input']      = $key1;
                        $data['tab']        = 'tab-proprie';
                        self::showreturn(false, $data);
                        exit;
                    }
                }
            }
        }

        foreach ($val as $key1 => $input) {
            foreach ($tab2 as $tab) {
                if ($key1 == $tab) {
                    if (!$input) {
                        $data['mensagem']   = "Peencha os campos obrigatórios!";
                        $data['input']      = $key1;
                        $data['tab']        = 'tab-estab';
                        self::showreturn(false, $data);
                        exit;
                    }
                }
            }
        }

        if (!$val->idcidade || !$val->idbairro) {
            $data['mensagem']   = "Informe um cep válido!";
            $data['input']      = 'endcep';
            $data['tab']        = 'tab-estab';
            self::showreturn(false, $data);
            exit;
        }

        foreach ($val as $key1 => $input) {
            foreach ($tab4 as $tab) {
                if ($key1 == $tab) {
                    if (!$input) {
                        $data['mensagem']   = "Peencha os campos obrigatórios!";
                        $data['input']      = $key1;
                        $data['tab']        = 'tab-adm';
                        self::showreturn(false, $data);
                        exit;
                    }
                }
            }
        }

        if ($val->senha != $val->conf_senha) {
            $data['mensagem']   = 'A senha e a confirmação de senha estão diferentes!';
            $data['input']      = ['senha', 'conf_senha'];
            $data['tab']        = 'tab-adm';
            self::showreturn(false, $data);
            exit;
        }

        if (strlen($val->senha) < 6) {
            $data['mensagem']   = 'A senha deve conter pelo menos 6 (seis) digitos!';
            $data['input']      = 'senha';
            $data['tab']        = 'tab-adm';
            self::showreturn(false, $data);
            exit;
        }

        if ($val->pessoa_juridica == 'N') {
            if (strlen($val->cnpj) < 14) {
                $data['mensagem']   = 'Parece que você não digitou todos os números do seu CPF';
                $data['input']      = 'cnpj';
                $data['tab']        = 'tab-proprie';
                self::showreturn(false, $data);
                exit;
            }
        } else {
            if (strlen($val->cnpj) < 18) {
                $data['mensagem']   = 'Parece que você não digitou todos os números do seu CNPJ';
                $data['input']      = 'cnpj';
                $data['tab']        = 'tab-proprie';
                self::showreturn(false, $data);
                exit;
            }
        }
    }
}
