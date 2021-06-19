<?php

namespace app\classes\widgets\container;
use app\classes\widgets\base\Element;

class Modal extends Element
{
    private $body, $header, $footer;

    public function __construct(string $modal_id, string $modal_class = '  modal-dialog-centered')
    {
        parent::__construct('div aria-hidden="true"');
        $this->class            = 'modal fade';
        $this->id               = $modal_id;
        $this->tabindex         = '-1';
        $this->role             = "dialog";

        $dialog = new Element('div');
        $dialog->class = 'modal-dialog';
        $dialog->class.= $modal_class;
        $dialog->role = 'document';

        $content = new Element('div');
        $content->class = 'modal-content';

        $this->header = new Element('div');
        $this->header->class= 'modal-header';

        $this->body = new Element('div');
        $this->body->class = 'modal-body';

        $this->footer = new Element('div');
        $this->footer->class = 'modal-footer';

        $content->add($this->header);
        $content->add($this->body);
        $content->add($this->footer);
        $dialog->add($content);

        $this->add($dialog);
    }

    public function addHeader($title, $jsfunc = null)
    {
        $h5 = new Element('h5');
        $h5->class = 'modal-title';
        $h5->add($title);

        $button = new Element('button aria-label="Close" onclick="' . $jsfunc . '"');
        $button->type = 'button';
        $button->class = 'close';

        $span = new Element('span aria-hidden="true"');
        $span->add('&times;');

        $button->add($span);
        $this->header->add($h5);
        $this->header->add($button);
        
    }

    public function addContent($content)
    {
        $container = new Element('div');
        $container->class = 'container-fluid';
        $container->add($content);
        $this->body->add($container);
    }

    public function addFooter($footer)
    {
        $this->footer->add($footer);
    }
}
