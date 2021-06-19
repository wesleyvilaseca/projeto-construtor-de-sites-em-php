<?php

namespace app\classes\widgets\form;

use app\classes\widgets\form\interfaces\FormElementInterface;
use app\classes\widgets\form\Field;
use app\classes\widgets\base\Element;


class Entry extends Field implements FormElementInterface
{
    protected $properties;

    /**
     * Exibe o widget na tela
     */
    public function show()
    {
        // atribui as propriedades da TAG
        $tag = new Element('input');
        $tag->class = 'field';    // classe CSS
        $tag->name = $this->name;                       // nome da TAG
        $tag->value = $this->value;                     // valor da TAG
        $tag->type = 'text';                            // tipo de input
        $tag->style = "width:{$this->size}"; // tamanho em pixels

        // se o campo não é editável
        if (!parent::getEditable()) {
            $tag->readonly = "1";
        }

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }

        // exibe a tag
        $tag->show();
    }
}