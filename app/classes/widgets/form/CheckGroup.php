<?php

namespace app\classes\widgets\form;

use app\classes\widgets\form\Field;
use app\classes\widgets\base\Element;
use app\classes\widgets\form\interfaces\FormElementInterface;

class CheckGroup extends Field implements FormElementInterface
{
    private $layout = 'vertical';
    private $itens;

    public function setLayout($dir)
    {
        $this->layout = $dir;
    }

    public function addItens($itens)
    {
        $this->itens = $itens;
    }

    public function show()
    {
        if($this->itens){
            foreach($this->itens as $index => $label){
                $button = new CheckButton("{$this->name}[]");
                $button->setValue($index);

                if(in_array($index, (array) $this->value)){
                    $button->setProperty('checked', '1');
                }

                $obj = new Label($label);
                $obj->add($button);
                $obj->show();
                if($this->layout == 'vertical'){
                    $br = new Element('br');
                    $br->show();
                    echo "\n";
                }
            }
        }
    }
}
