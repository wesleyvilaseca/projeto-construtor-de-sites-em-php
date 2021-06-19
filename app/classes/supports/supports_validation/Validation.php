<?php

namespace app\classes\supports\supports_validation;

use app\classes\supports\supports_log\LogFile;

trait Validation
{
    use LogFile;

    /*
        *0 - aconteceu um erro interno em algum procedimento da api
        *1 - a sua solicitação foi realizada com sucesso
        *2 - é somente um aviso da API, mas sua solicitação foi um sucesso 
        *3 - token é invalido "expirado, formato invalido e etc" -> destruir a sessão e pedir login
        */

    public static function recaptchaValidation($secretkey)
    {
        if ($secretkey) {
            $ip = $_SERVER['REMOTE_ADDR'];
            $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . SECRET_KEY . "&response={$secretkey}&remoteip={$ip}"));
            if ($response->success == false) {
                $data['mensagem']   = 'Preecha o recaptcha!';
                self::showreturn(false, $data);
                exit;
            }
        } else {
            $data['mensagem']   = 'Error na validação do recapatcha!';
            self::showreturn(false, $data);
            exit;
        }
    }

    public static function requestVerify($result, $req = null) //validação de chamadas no carregamento da página
    {
        if ($result == '' || $result == null || !isset($result)) {
            self::setlog(json_encode($result), $req);
            (self::isAjax()) ? self::showreturn(false, ['mensagem' => 'Aconteceu um erro interno, tente mais tarde!']) : self::phpAlert("Aconteceu um erro interno, tente mais tarde!");
            return false;
        } else {
            if ($result->result_code != 1) {
                self::setlog(json_encode($result), $req);
                if ($result->result_code == 3) {
                    self::exit($result);
                } else {
                    (self::isAjax()) ? self::showreturn(false, ['mensagem' => 'Aconteceu um erro na requisição!']) : self::phpAlert("Aconteceu um erro na requisição!");
                }
                return false;
            }
            return true;
        }
    }

    public static function verificaResult($result, $req = null) //registro de exceções
    {
        if ($result == '' || $result == null || !isset($result)) {
            $data['mensagem']       = 'Aconteceu um erro interno, tente mais tarde...';
            self::setlog(json_encode($result), $req);
            self::showreturn(false, $data);
            exit;
        } else {
            //$requisicao = json_decode($req);
            if ($result->result_code != 1) {
                if ($result->msgshow_finaluser == true) {
                    $data['mensagem']       = $result->result_msg;
                    $data['result_content'] = @$result->result_content;
                    self::showreturn(false, $data);
                    exit;
                } else {
                    if ($result->result_code == 3) { //erro grave
                        self::setlog(json_encode($result), $req);
                        $data['mensagem']       = $result->result_msg;
                        $data['invalid_token']  = true;
                        $data['redirect']       = URL_BASE;
                        self::showreturn(false, $data);
                        exit;
                    } else {
                        (self::isAjax()) ? self::showreturn(false, ['mensagem' => 'Algo deu errado :(']) : self::phpAlert("Algo deu erro :(");
                        self::setlog(json_encode($result), $req);
                        exit;
                    }
                }
            }
        }
    }

    public static function phpAlert($msg, string $redirect = null)
    {
        $retorno = '<script type="text/javascript"> alert("' . $msg . '");';
        if ($redirect) {
            $retorno .= 'window.location.href="' . $redirect . '"';
        }
        $retorno .= '</script>';
        echo $retorno;
    }

    private static function exit($result)
    {
        if (self::isAjax()) {
            $data['mensagem']       = $result->result_msg;
            $data["reditect"]       = URL_BASE;
            $data['invalid_token']  = true;
            self::showreturn(false, $data);
        } else {
            self::phpAlert($result->result_msg, URL_BASE);
        }
    }

    public static function isAjax()
    {
        if (
            !empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
        )
            return true;
        else
            return false;
    }

    public static function showreturn($success, array $data = null)
    { //mostrar o retorno da api ou alguma mensagem para o usuario
        $dados['success']   = $success;
        $dados['result']    = $data;
        echo json_encode($dados);
    }
}
