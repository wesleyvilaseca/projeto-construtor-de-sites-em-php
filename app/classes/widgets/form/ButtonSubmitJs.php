<?php

namespace app\classes\widgets\form;

use app\classes\widgets\form\Field;
use app\classes\widgets\base\Element;
use app\classes\widgets\form\interfaces\FormElementInterface;

class ButtonSubmitJs extends Field implements FormElementInterface
{
    private $action;
    private $label;
    private $formName;

    /**
     * Define a ação do botão (função a ser executada)
     * @param $action = ação do botão
     * @param $label    = rótulo do botão
     */
    public function setAction($action, $label)
    {
        $this->action     = $action;
        $this->label      = $label;
    }

    /**
     * Define o nome do formulário para a ação botão
     * @param $name = nome do formulário
     */
    public function setFormName($name)
    {
        $this->formName = $name;
    }

    /**
     * exibe o botão
     */
    public function show()
    {
        //$url = $this->action->serialize();
        // $url = $this->action;

        // define as propriedades do botão
        $tag = new Element('button');
        $tag->name    = $this->name;    // nome da TAG
        $tag->type    = 'submit';       // tipo de input
        $tag->add($this->label);

        // define a ação do botão
        $tag->onclick =   $this->action;

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }

        // exibe o botão
        $tag->show();
    }
}
