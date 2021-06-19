<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Departaments extends DataLayer
{
    public function __construct()
    {
        parent::__construct('departaments', ['description', 'enable'], 'id', false);
    }

    public function getDepartaments()
    {
        $a = [];
        $result = $this->find()->fetch(true);
        if ($result) {
            $a['n'] = 'Selecione uma opção';
            foreach ($result as $parent) {
                if ($parent->parent_id) {
                    $parentid = $parent->parent_id;
                    $departamento = $parent->description;
                    $i = true;
                    while ($i) {
                        $dad = $this->findById($parentid);
                        $departamento = $dad->description . ' > ' . $departamento;
                        if (!$dad->parent_id)
                            break;
                        else
                            $parentid = $dad->parent_id;
                    }
                    $a[$parent->id] = $departamento;
                } else {
                    $a[$parent->id] = $parent->description;
                }
            }
            return $a;
        } else {
            return ['n' => 'Não há departamentos cadastrados'];
        }
    }
}
