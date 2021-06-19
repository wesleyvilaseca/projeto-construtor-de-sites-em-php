<?php

use app\classes\supports\supports_cripto\Cripto;

function validaCNPJ($cnpj)
{
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
    $cnpj = (string)$cnpj;
    $cnpj_original = $cnpj;
    $primeiros_numeros_cnpj = substr($cnpj, 0, 12);

    if (!function_exists('multiplica_cnpj')) {
        function multiplica_cnpj($cnpj, $posicao = 5)
        {
            $calculo = 0;
            for ($i = 0; $i < strlen($cnpj); $i++) {
                $calculo = $calculo + ($cnpj[$i] * $posicao);
                $posicao--;
                if ($posicao < 2) {
                    $posicao = 9;
                }
            }
            return $calculo;
        }
    }

    $primeiro_calculo = multiplica_cnpj($primeiros_numeros_cnpj);
    $primeiro_digito = ($primeiro_calculo % 11) < 2 ? 0 :  11 - ($primeiro_calculo % 11);
    $primeiros_numeros_cnpj .= $primeiro_digito;
    $segundo_calculo = multiplica_cnpj($primeiros_numeros_cnpj, 6);
    $segundo_digito = ($segundo_calculo % 11) < 2 ? 0 :  11 - ($segundo_calculo % 11);

    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

    if ($cnpj === $cnpj_original) {
        return true;
    }
}

function validaCPF($cpf = null)
{

    if (empty($cpf)) {
        return false;
    }

    $cpf = preg_replace("/[^0-9]/", "", $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    if (strlen($cpf) != 11) {
        return false;
    } else if (
        $cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999'
    ) {
        return false;
    } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }
}

function tofloat($num)
{
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    if (($dotPos > $commaPos) && $dotPos) {
        $sep = $dotPos;
    } elseif (($commaPos > $dotPos) && $commaPos) {
        $sep = $commaPos;
    } else {
        $sep = false;
    }

    if (!$sep) {
        return strval(floatval(preg_replace("/[^0-9]/", "", $num)));
    }
    return strval(floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
    ));
}

function numberFormat($number, $decimals = 2, $sep = ",", $k = "")
{
    $var = number_format($number, $decimals, $sep, $k);
    return  $var;
}

function getToken(): string
{
    $dia = date('d');
    $mes = date('m');
    $ano = date('Y');

    $hora = date('H');
    $minuto = date('i');
    $segundo = date('s');

    $token =  base64_encode($dia . $mes . $ano . $hora . $minuto . $segundo . ($dia + $hora) . ($mes + $minuto) . ($ano + $segundo)) . "." . addDateToken();
    return $token;
}


function addDateToken(): string
{
    date_default_timezone_set('America/Belem');
    $now = date("d-m-Y H:i:s");
    $data_encondada = base64_encode($now);
    return $data_encondada;
}

function dd($val)
{
    print '<pre>';
    print_r($val);
    print '</pre>';
    exit;
}

function validBase64($string)
{
    $decoded = base64_decode($string, true);

    // Check if there is no invalid character in string
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

    // Decode the string in strict mode and send the response
    if (!$decoded) return false;

    // Encode and compare it to original one
    if (base64_encode($decoded) != $string) return false;

    return true;
}

function geturl()
{
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link;
}

function ecryptKey($val, $key, $newkey)
{
    foreach ($val as $item) {
        $item->$newkey = Cripto::encrypt(json_encode([$newkey => $item->$key]));
        $a[] = $item;
    }
    return $a;
}

function b64encode($str)
{
    return strtr(base64_encode($str), '+/=', '._-');
}

function b64decode($str)
{
    return base64_decode(strtr($str, '._-', '+/='));
}

function filterpost($request, $item = null)
{
    foreach ($request as $key => $input) {
        $request[$key] =  isset($_POST[$key]) ? strip_tags(filter_input(INPUT_POST, $key)) : null;
    }
    return $request;
}

function module_settings($request)
{
    $settings = [];
    foreach ($request as $key => $item) {
        if ($key !== 'description' and $key !== 'enable') {
            $settings[$key] = $item;
        }
    }
    return json_encode($settings);
}

function message()
{
    return [
        '1' => [
            'tipo'  => 'success',
            'msg'   => 'Cadastro efetuado com sucesso'
        ],
        '2' => [
            'tipo' => 'success',
            'msg'   => 'Item editato com sucesso'
        ],
        '3' => [
            'tipo' => 'success',
            'msg'   => 'Item removido com sucesso'
        ],
        '4' => [
            'tipo'  => 'danger',
            'msg'   => 'Operação não autorizada'
        ],
        '5' => [
            'tipo'  => 'warning',
            'msg'   => 'Os campos com asterisco (*) são obrigatórios'
        ]
    ];
}

function imageupload($file, array $quality = null)
{
    $image = new CoffeeCode\Uploader\Image("storage", "images");
    $src = $image->upload($file, pathinfo($file['name'], PATHINFO_FILENAME));
    return $src;
    //$upload = new CoffeeCode\Uploader\File("storage", 'files');
    //$upload = new CoffeeCode\Uploader\Media("storage", 'media');
    //$upload = new CoffeeCode\Uploader\Send("storage", 'media', [], []);
}

function redirectBack()
{
    $location = $_SERVER['HTTP_REFERER'];
    if (!isset($location)) {
        dd('redirectback');
    } else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    exit;
}

function redirect(string $route, string $params = null)
{
    if ($params)
        $route = $route . $params;

    header('Location: ' . $route);
    exit;
}

function dataModule($data)
{
    $data->settings = json_decode($data->settings);
    foreach ($data->settings as $key => $setting) {
        $data->$key = $setting;
    }
    unset($data->settings);
    return $data;
}

function setmessage(array $val)
{
    $_SESSION['msg'] = $val;
}

function getmessage()
{
    $message = @$_SESSION['msg'];
    return $message;
}

function setdataform($data)
{
    $_SESSION['dataform'] = json_encode($data);
}

function getdataform()
{
    $form = @$_SESSION['dataform'];
    return json_decode($form);
}

function destroydataform()
{
    unset($_SESSION['dataform']);
}

function setSession($key, $val)
{
    $_SESSION[$key] = $val;
}

function getSession($key)
{
    return @$_SESSION[$key];
}

function sessionDestroy($key)
{
    if (@$_SESSION[$key])
        unset($_SESSION[$key]);
}
