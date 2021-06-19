<?php

namespace app\classes\widgets\form;

use app\classes\widgets\form\wrapper\FormWrapper;
use app\models\DefaultModel;

class FormGenerate
{
    private $inputs, $combos, $form, $text;
    private $dadosdic;
    private $action;
    private $dadositem;
    private $formEditable;
    private $model;

    public function __construct($dadosdic, $action, $tipoaction = 's', $dadositem = null, $formEditable = true)
    {
        $name = $dadosdic[0]->tabela;
        $this->form             = new FormWrapper(new Form($name), $tipoaction);
        $this->dadosdic         = $dadosdic;
        $this->action           = $action;
        $this->dadositem        = $dadositem;
        $this->formEditable     = $formEditable;
        $this->model            = new DefaultModel;

        foreach ($this->dadosdic as $dados) {
            if ($dados->tipo == 'T') {
                $entry = new Entry($dados->campo);
                $this->setProperty($dados, $entry);
                $this->form->addField($entry, $dados->titulo, @$dados->coluna ? 'col-md-' . $dados->coluna : '');
            } elseif ($dados->tipo == 'N') {
                $entry = new Number($dados->campo);
                $dados = $this->setProperty($dados, $entry);
                $this->form->addField($entry, $dados->titulo, @$dados->coluna ? 'col-md-' . $dados->coluna : '');
            } elseif ($dados->tipo == 'L') {
                if ($dados->lista) {
                    if (strpos($dados->lista, 'select') !== false) {
                        $select = $this->model->get($dados->lista)->fetchAll();
                    }
                }
                $entry = new Combo($dados->campo);
                $this->setProperty($dados, $entry);
                $itens = [];
                $itens[null] = '';
                foreach ($select as $item) {
                    $key = array_keys(get_object_vars($item))[0];
                    $opcao = explode('-', $item->$key);
                    $itens[$opcao[0]] = $opcao[1];
                }
                $entry->addItems($itens);
                $this->form->addField($entry, $dados->titulo, @$dados->coluna ? 'col-md-' . $dados->coluna : '');
            }
            else if($dados->tipo == 'IF') {
                $entry = new File($dados->campo);
                $dados = $this->setProperty($dados, $entry);
                $this->form->addField($entry, $dados->titulo, @$dados->coluna ? 'col-md-' . $dados->coluna : '');
            }
        }
        

        $inputhidden = new Hidden('form');
        $inputhidden->setProperty('value', $name);
        $this->form->addField($inputhidden);

        if ($this->dadositem)
            $this->form->setData($this->dadositem);

        $this->form->addAction($this->action->label, $this->action->action);
    }

    private function setProperty(object $data, object $field)
    {
        $field->setEditable($this->formEditable);
        if ($data->obrigatorio == 'S') {
            $data->titulo = $data->titulo . ' *';
            //$field->setProperty('required', 'required');
        }

        if ($data->valorpadrao and !$this->dadositem) {
            $field->setProperty('value', $data->valorpadrao);
        }

        return $data;
    }

    public function getForm()
    {
        return $this->form->getForm();
    }
}
