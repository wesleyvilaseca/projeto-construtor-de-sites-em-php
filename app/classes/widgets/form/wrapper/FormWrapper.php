<?php

namespace app\classes\widgets\form\wrapper;

use app\classes\widgets\form\Form;
use app\classes\widgets\form\ButtonSubmitJs;
use app\classes\widgets\base\Element;
use app\classes\widgets\form\Button;
use app\classes\widgets\form\ButtonSubmit;

class FormWrapper
{
    private $decorated;
    private $form;

    public function __construct(Form $form)
    {
        $this->decorated    = $form;
    }

    public function __call($methodname, $parameters)
    {
        return call_user_func_array([$this->decorated, $methodname], $parameters);
    }

    public function show($method = 'POST', $autocomplete = 'off', $list = 'autocompleteOff')
    {
        $this->form = new Element('form autocomplete="' . $autocomplete . '" list="' . $list . '"');
        $this->form->class     = 'row';
        $this->form->enctype   = 'multipart/form-data';
        $this->form->method    = $method;
        $this->form->name      = $this->decorated->getName();
        $this->form->id        = $this->decorated->getName();
        $this->form->widht     = '100%';

        if (!$this->decorated->getActionInBottom())
            $this->setActions();

        foreach ($this->decorated->getFields() as $field) {
            $group = new Element('div');
            $group->class = 'form-group mb-2' . ' ' . $field->getExtraClassCss();

            if ($field->getLabel()) {
                $label = new Element('small');
                $label->class = 'control-label';
                $label->add($field->getLabel());
                $group->add($label);
            }

            $col = new Element('div');
            $col->add($field);
            $field->class = 'form-control' . $field->getIsTextEditor();
            $group->add($col);
            $group->add($field->getExtraElement());
            $this->form->add($group);
        }

        if ($this->decorated->getActionInBottom()) {
            $hr = new Element('hr');
            $this->form->add($hr);
            $this->setActions();
        }

        $this->form->show();
    }

    private function setActions()
    {
        $section = new Element('div');
        $section->class = "row";
        foreach ($this->decorated->getActions() as $label => $action) {
            $name = strtolower(str_replace(' ', '_', $label));

            if ($this->decorated->getJsAction() && $action->submit)
                $button = new ButtonSubmitJs('');
            else if (!$this->decorated->getJsAction() && $action->submit)
                $button = new ButtonSubmit('');
            else
                $button = new Button('');

            if (@$action->id)
                $button->setProperty("id", $action->id);

            $button->setAction($action->route, $label);
            $button->setFormName($this->decorated->getName());

            if ($action->css)
                $button->class = 'btn ' . $action->css;
            else
                $button->class = 'btn btn-default';

            if ($this->decorated->getActionInBottom()) {
                $divBtn = new Element('div');
                $divBtn->class = "col-xl-6 col-md-12 mt-2";
                $divBtn->add($button);
            }
            $section->add($this->decorated->getActionInBottom() ? $divBtn : $button);
        }
        $this->form->add($section);
    }

    public function __toString()
    {
        ob_start();
        $this->show();
        $content = ob_get_clean();
        return $content;
    }

    public function getForm()
    {
        return self::__toString();
    }
}
