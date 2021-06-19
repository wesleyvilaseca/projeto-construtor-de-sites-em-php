<?php

namespace app\controllers;

use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\Password;
use app\classes\widgets\form\wrapper\FormWrapper;
use app\core\Controller;
use app\models\User;

class AdminController extends Controller
{
    private $repository;

    public function __construct()
    {
        $this->repository = new User;
    }

    public function index()
    {
        $dados['title']        = 'Login Administração';
        $dados["form"]         = $this->formlogin();
        $dados['js']           = $this->js();
        $view                  = "institucional/pages/login/index";
        $this->renderView($view, $dados);
    }

    public function logar()
    {
        $request    = $_POST;
        if (isset($request)) {
            filterpost($request);
        }

        if (!$request['email'] || !$request['senha']) {
            setmessage(['tipo' => 'warning', 'msg' => 'os campos com asterisco são de preenchimento obrigatório']);
            $this->index();
            exit;
        }

        $usuario = $this->repository->find("email =:email AND senha =:senha AND enabled = :ativado AND enable = :ativo", "ativado=S&ativo=S&email={$request['email']}&senha=" . md5($request['senha']))->fetch();
        if (!$usuario) {
            setmessage(['tipo' => 'warning', 'msg' => 'Usuario não encontrado']);
            $this->index();
            exit;
        }
        $this->setSession((object)[
            'email' => $usuario->email,
            'id'    => $usuario->id,
            'nome'  => $usuario->nome
        ], 'admin');
        header("Location: " . URL_BASE  . 'admin-catalog-home');
    }

    public function logout()
    {
        $this->sessionDestroi('admin', URL_BASE . 'admin');
    }

    private function formlogin()
    {
        $form = new FormWrapper(new Form('login'));
        $email = new Entry('email');
        $senha = new Password('senha');
        $form->addField($email, ['label' => 'Email *', 'css' => 'mb-4']);
        $form->addField($senha, ['label' => 'Senha *', 'css' => 'mb-4']);
        $form->addAction('Logar', (object)['css' => 'btn btn-primary', 'route' => URL_BASE . 'admin/logar', 'submit' => true]);

        return $form->getForm();
    }

    private function js()
    {
        $js = $this->jquery();
        $js .= $this->recaptcha();
        $js .= $this->bootstrapjs();
        $js .= $this->carousel_js();
        $js .= $this->carousel_min_js();
        return $js;
    }
}
