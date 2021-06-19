<?php

namespace app\classes\widgets\form;

use app\classes\widgets\form\interfaces\FormElementInterface;

class Form
{
    protected $title;
    protected $name;
    protected $fields;
    protected $actions;
    protected $actionInBottom;
    protected $jsAction;

    /**
     * Instancia o formulário
     * @param $name = nome do formulário
     */
    public function __construct($name = 'my_form')
    {
        $this->setName($name);
        $this->setActionInBottom();
        $this->setJsAction();
    }

    /**
     * Define o nome do formulário
     * @param $name = nome do formulário
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Retorna o nome do formulário
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Define o título do formulário
     * @param $title Título
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Retorna o título do formulário
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add a form field
     * @param $label     Field Label
     * @param $object    Field Object
     * @param $size      Field Size
     */
    public function addField(FormElementInterface $object, array $definition)
    {
        $object->setSize(@$definition['size'] ?: '100%');
        $object->setLabel(@$definition['label']);
        $object->setExtraClassCss(@$definition['css']);
        $object->setIsTextEditor(@$definition['editor'] ?: false);
        $object->setExtraElement(@$definition['element']);
        $this->fields[$object->getName()] = $object;
    }

    /**
     * Adiciona uma ação
     * @param $label  Action Label
     * @param $action TAction Object
     */
    public function addAction($label, $action)
    {
        $this->actions[$label] = $action;
    }

    /**
     * Retorna os campos
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Retorna as ações
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Informa se a posição dos botões do formulario fica no topo ou no rodapé
     */

    public function setActionInBottom($actionInBottom = true)
    {
        $this->actionInBottom = $actionInBottom;
    }

    public function getActionInBottom()
    {
        return $this->actionInBottom;
    }

    /**
     * para o caso de querer fazer as requisições via js
     */

    public function setJsAction($jsAction = false)
    {
        $this->jsAction = $jsAction;
    }

    public function getJsAction()
    {
        return $this->jsAction;
    }


    /**
     * Atribui dados aos campos do formulário
     * @param $object = objeto com dados
     */
    public function setData($object)
    {
        foreach ($this->fields as $name => $field) {
            if ($name and (is_array($object) ? isset($object[$name]) : isset($object->$name))) {
                $field->setValue(is_array($object) ? $object[$name] : $object->$name);
            }
        }
    }

    /**
     * Retorna os dados do formulário em forma de objeto
     */
    public function getData($class = 'stdClass')
    {
        $object = new $class;

        foreach ($this->fields as $key => $fieldObject) {
            $val = isset($_POST[$key]) ? $_POST[$key] : '';
            $object->$key = $val;
        }
        // percorre os arquivos de upload
        foreach ($_FILES as $key => $content) {
            $object->$key = $content['tmp_name'];
        }
        return $object;
    }
}
