<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Module extends DataLayer
{
    public function __construct()
    {
        parent::__construct('module', ['description', 'module_code', 'settings', 'enable'], 'id', false);
    }

    public function getModules()
    {
        $modules = $this->find()->fetch(true);
        $a = [];
        $a['n'] = 'Selecione uma opção';
        foreach ($modules as $module) {
            $a[$module->id] = $module->description;
        }
        return $a;
    }
}
