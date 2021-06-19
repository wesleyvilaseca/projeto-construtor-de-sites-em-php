<?php
namespace app\classes\widgets\form;

use app\classes\widgets\form\interfaces\FormElementInterface;
use app\classes\widgets\base\Element;

class Combo extends Field implements FormElementInterface
{
    private $items; // array contendo os itens da combo
    protected $properties;
    
    /**
     * Adiciona items à combo box
     * @param $items = array de itens
     */
    public function addItems($items)
    {
        $this->items = $items;
    }
    
    /**
     * Exibe o widget na tela
     */
    public function show()
    {
        $tag = new Element('select');
        $tag->class = 'combo';
        $tag->name = $this->name;
        $tag->style = "width:{$this->size}"; // tamanho em pixels
        
        if ($this->items)
        {
            // percorre os itens adicionados
            foreach ($this->items as $chave => $item)
            {
                // cria uma TAG <option> para o item
                if($chave == 'n'){
                    $option = new Element('option selected disabled');
                } else {
                    $option = new Element('option');
                }
                //$option = new Element('option');
                $option->value = $chave; // define o índice da opção
                $option->add($item);     // adiciona o texto da opção
                
                // caso seja a opção selecionada
                if ($chave == $this->value)
                {
                    // seleciona o item da combo
                    $option->selected = 1;
                }
                // adiciona a opção à combo
                $tag->add($option);
            }
        }
        
        // verifica se o campo é editável
        if (!parent::getEditable())
        {
            // desabilita a TAG input
            $tag->readonly = "1";
        }
        
        if ($this->properties)
        {
            foreach ($this->properties as $property => $value)
            {
                $tag->$property = $value;
            }
        }
        
        // exibe a combo
        $tag->show();
    }
}
