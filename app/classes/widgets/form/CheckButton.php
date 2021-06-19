<?php

namespace app\classes\widgets\form;

use app\classes\widgets\form\Field;
use app\classes\widgets\base\Element;
use app\classes\widgets\form\interfaces\FormElementInterface;

class CheckButton extends Field implements FormElementInterface
{
    public function show()
    {
        $tag = new Element('input');
        $tag->class     = 'field';
        $tag->name      = $this->name;
        $tag->value     = $this->value;
        $tag->type      = 'checkbox';

        if (!parent::getEditable()) {
            $tag->readonly = '1';
        }

        if ($this->properties) {
            foreach ($this->properties as $property => $value) {
                $tag->$property = $value;
            }
        }
        $tag->show();
    }
}
