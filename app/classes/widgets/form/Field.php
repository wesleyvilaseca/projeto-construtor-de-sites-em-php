<?php

namespace app\classes\widgets\form;

use app\classes\widgets\form\interfaces\FormElementInterface;

abstract class Field implements FormElementInterface
{
    protected $name;
    protected $size;
    protected $value;
    protected $editable;
    protected $formLabel;
    protected $properties;
    protected $extraClassCss;
    protected $isTextEditor;
    protected $extraElement;

    /**
     * Instancia um campo do formulario
     * @param $name = nome do campo
     */
    public function __construct($name, $editable = true)
    {
        // define algumas características iniciais
        $this->setEditable($editable);
        $this->setName($name);
    }

    /**
     * Define uma propriedade para o campo
     * @param $name = nome da propriedade
     * @param $valor = valor da propriedade
     */
    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }

    /**
     * Retorna uma propriedade do campo
     */
    public function getProperty($name)
    {
        return $this->properties[$name];
    }

    /**
     * Intercepta a atribuição de propriedades
     * @param $name     Nome da propriedade
     * @param $value    Valor da propriedade
     */
    public function __set($name, $value)
    {
        // Somente valores escalares
        if (is_scalar($value)) {
            // Armazena o valor da propriedade
            $this->setProperty($name, $value);
        }
    }

    /**
     * Retorna o valor da propriedade
     * @param $name Nome da propriedade
     */
    public function __get($name)
    {
        return $this->getProperty($name);
    }

    /**
     * Define o nome do widget
     * @param $name     = nome do widget
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Retorna o nome do widget
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Define o label do widget
     * @param $label = widget label
     */
    public function setLabel($label)
    {
        $this->formLabel = $label;
    }

    /**
     * Retorna o label do widget
     */
    public function getLabel()
    {
        return $this->formLabel;
    }


    /**
     * Define o valor de um campo
     * @param $value    = valor do campo
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Retorna o valor de um campo
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Define se o campo poderá ser editado
     * @param $editable = TRUE ou FALSE
     */
    public function setEditable($editable)
    {
        $this->editable = $editable;
    }

    /**
     * Retorna o valor da propriedade $editable
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * Define a largura do widget
     * @param $width = largura em pixels
     * @param $height = altura em pixels (usada em TText)
     */
    public function setSize($width, $height = NULL)
    {
        $this->size = $width;
    }

    public function setExtraClassCss($extraClassCss)
    {
        $this->extraClassCss = $extraClassCss;
    }

    public function getExtraClassCss()
    {
        return $this->extraClassCss;
    }

    public function setExtraElement($extraElement)
    {
        $this->extraElement = $extraElement;
    }

    public function getExtraElement()
    {
        return $this->extraElement;
    }

    public function setIsTextEditor(bool $isEditor)
    {
        if ($isEditor)
            $this->isTextEditor = ' editor';
        else
            $this->isTextEditor = '';
    }

    public function getIsTextEditor()
    {
        return $this->isTextEditor;
    }
}
