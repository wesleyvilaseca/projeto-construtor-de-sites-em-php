<?php
namespace app\classes\widgets\form;

use app\classes\widgets\form\interfaces\FormElementInterface;
use app\classes\widgets\base\Element;

class Text extends Field implements FormElementInterface
{
    private $width;
    private $height = 100;
    
    /**
     * Define o tamanho de um campo de texto
     * @param $width  = largura
     * @param $height = altura
     */
    public function setSize($width, $height = NULL)
    {
        $this->size = $width;
        
        if (isset($height))
        {
            $this->height = $height;
        }
    }
    
    /**
     * Exibe o widget na tela
     */
    public function show()
    {
        $tag = new Element('textarea');
        $tag->class = 'field';		  // classe CSS
        $tag->name = $this->name; // nome da TAG
        $tag->style = "width:{$this->size};height:{$this->height}"; // tamanho em pixels
        
        // se o campo não é editável
        if (!parent::getEditable())
        {
            // desabilita a TAG input
            $tag->readonly = "1";
        }
        
        // adiciona conteúdo ao textarea
        $tag->add(htmlspecialchars($this->value));
        
        if ($this->properties)
        {
            foreach ($this->properties as $property => $value)
            {
                $tag->$property = $value;
            }
        }
        
        // exibe a tag
        $tag->show();
    }

}
