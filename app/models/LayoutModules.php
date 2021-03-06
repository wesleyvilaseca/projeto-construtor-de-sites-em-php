<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class LayoutModules extends DataLayer
{
    public function __construct()
    {
        parent::__construct('layout_modules', [], 'id', false);
    }

    public function list($position = "C", $id_layout)
    {
        $module = new Module;
        $list = $this->find("position=:position and layout_id=:layout_id", "position={$position}&layout_id={$id_layout}")->order("sort_order ASC")->fetch(true);
        if ($list) {
            foreach ($list as $key => $item) {
                $m = $module->findById($item->module_id);
                $item->description = $m->description;
                $list[$key] = $item;
            }
        }
        return $list;
    }
}
