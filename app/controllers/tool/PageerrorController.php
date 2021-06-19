<?php

namespace app\controllers\tool;

use app\core\Controller;
use app\classes\widgets\base\Element;
use app\classes\widgets\container\Modal;
use app\classes\widgets\form\Combo;
use app\classes\widgets\form\Form;
use app\classes\widgets\form\Entry;
use app\classes\widgets\form\Text;
use app\classes\widgets\wrapper\FormWrapper;
use stdClass;

class PageerrorController extends Controller
{
    public function index($erro = null)
    {
        $dados["erro"]          = $erro;
        $dados['usuario']       = $this->getUser();
        $dados['title']         = 'Erro inesperado';
        $dados['imgerror']      =  '<img id="img-error" src="'. URL_BASE .'assets/adm/images/404page.jpg" alt="">';
        /*$dados["p"]           = $this->paragrafo();
        $dados["modal"]         = $this->modal();
        $dados["usuario"]       = $this->getUser();
        $dados["form"]          = $this->form();
        $dados['btnmodal']      = $this->btnmodal();*/
        $dados["view"]          = "adm/pages/pageerror/index";
        $dados['includemenu']   = 'app/views/adm/template/sidemenu.php';
        $this->load("adm/template", $dados);
    }

    public function btnmodal()
    {
        $button = new Element('button data-toggle="modal" data-target="#testemodal"');
        $button->class = 'btn btn-info btn-sm';
        $button->add('modalteste');
        return $button->getElement();
    }

    public function paragrafo()
    {
        $div = new Element('div');
        $div->style = 'text-align:center;';
        $div->style .= 'font-weight:bold;';
        $div->style .= 'color:red;';

        $p = new Element('p');
        $p->add('isto é um paragrafo');

        $div->add($p);
        return $div->getElement();
    }

    public function modal()
    {
        $modal = new Modal('testemodal');
        $modal->addHeader('modalteste', "closeteste('testemodal')");
        $p = new Element('p');
        $p->add('este é um modal teste');
        $modal->addContent(self::form());
        return $modal->getElement();
    }

    public function form()
    {
        
        $form = new FormWrapper(new Form('form_teste'));
        $form->setTitle('form_teste');

        $nome = new Entry('nome');
        $email = new Entry('email');
        $assunto = new Combo('assunto');
        $msg = new Text('msg');

        $form->addField('Nome', $nome, 100);
        $form->addField('Email', $email);
        $form->addField('Assunto', $assunto);

        $assunto->addItems([
            'n' => 'Selecione uma opção',
            '1' => 'Sujestão',
            '2' => 'Reclamação',
            '3' => 'Suporte',
            '4' => 'Cobrança',
            '5' => 'outros'
        ]);

        $form->addField('Mensagem', $msg);
        $form->setCallfuncjs(true);

        $form->addAction('enviar', 'teste()');
        $teste =  $form->getForm();
        return $teste;
    }

    public function erro($erro = null)
    {
        $this->index($erro);
    }

    public function logerror()
    {
        $form = isset($_POST["formulario"]) ? strip_tags(filter_input(INPUT_POST, "formulario")) : NULL;
        self::setlog(json_decode($form));
    }
}
