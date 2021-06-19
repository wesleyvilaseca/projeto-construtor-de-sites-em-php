<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class LayoutModules extends DataLayer
{
    public function __construct()
    {
        parent::__construct('layout_modules', [], 'id', false);
    }

    public function list($position = "C")
    {
        $module = new Module;
        $list = $this->find("position=:position", "position={$position}")->fetch(true);
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
