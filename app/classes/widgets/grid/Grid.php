<?php

namespace app\classes\widgets\grid;

use app\classes\supports\supports_cripto\Cripto;
use Naucon\HtmlBuilder\HtmlAnchor;
use Naucon\HtmlBuilder\HtmlBuilder;
use Naucon\HtmlBuilder\HtmlDiv;
use Naucon\HtmlBuilder\HtmlTable;

class Grid
{
    private $tabletitle, $tablebody, $tablefields;
    private $table, $html;
    private $bloco;
    use Cripto;

    public function __construct($bloco, $tablefields, $tablebody, $tabletitle = null)
    {
        $this->bloco             = $bloco;
        $this->tabletitle        = $tabletitle;
        $this->tablebody         = $tablebody;
        $this->tablefields       = $tablefields;
        $this->table             = new HtmlTable();
        $this->setGrid();
    }

    private function setGrid(): void
    {
        $div = new HtmlDiv();
        $div->setAttribute('class', 'table-responsive');

        $this->table->addHeader();
        $tableRow = $this->table->addRow();
        if ($this->tabletitle) {
            for ($i = 0; $i < sizeof($this->tabletitle); $i++) {
                $tableRow->addHeader($this->tabletitle[$i]);
            }
        } else {
            for ($i = 0; $i < sizeof($this->tablefields); $i++) {
                $tableRow->addHeader($this->tablefields[$i]);
            }
        }
        $tableRow->addHeader('Ação');

        $this->table->addBody();
        for ($i = 0; $i < sizeof($this->tablebody); $i++) {
            $tableRow = $this->table->addRow();
            foreach ($this->tablefields as $field) {
                foreach ($this->tablebody[$i] as $key => $itemRow) {
                    if ($key == $field) {
                        $tableRow->addData($itemRow);
                    }
                    if ($key == 'id') {
                        $divacao = new HtmlDiv();
                        $parametros = $this->encrypt(json_encode(['idbloco' => $this->bloco->id, 'iditem' => $itemRow]));
                        if ($this->bloco->edita == 'S') {
                            $btnedit = new HtmlAnchor(URL_BASE . 'admin-default/editar/' . $parametros, 'Editar', '');
                            //$btnedit = new HtmlAnchor(URL_BASE . 'admin-default/editar/' . $this->bloco->id . '/'. $itemRow, 'Editar', '');
                            $btnedit->setAttribute('class', 'btn btn-success me-2');
                            $divacao->addChildElement($btnedit);
                        }
                        if ($this->bloco->exclui == 'S') {
                            $btndel = new HtmlAnchor(URL_BASE . 'admin-default/apagar/' . $parametros, 'Deletar', '');
                            $btndel->setAttribute('class', 'btn btn-danger');
                            $divacao->addChildElement($btndel);
                        }
                    }
                }
            }
            $tableRow->addData($divacao);
        }

        $this->table->setAttribute('class', 'table table-striped table-bordered responsive dataTable no-footer dtr-inline');
        $this->table->setAttribute('id', 'example');
        $div->setContent($this->table);
        $htmlbuilder = new HtmlBuilder;
        $this->html = $htmlbuilder->render($div);
    }

    public function getGrid()
    {
        return $this->html;
    }
}
