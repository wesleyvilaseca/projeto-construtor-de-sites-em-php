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
            $a[''] = '-- Vazio --';
            foreach ($result as $parent) {
                //dd($parent);
                if ($parent->parent_id) {
                    $parentid = $parent->parent_id;
                    $departamento = $parent->description;
                    $i = true;
                    while ($i) {
                        $dad = $this->findById($parentid);
                        if (!$dad) break;
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


    public function getMenus()
    {
        //encadeamente de menus em até 3 niveis por questões de layout;
        $dad_menus = $this->find("top=:top and enable=:enable", "top=S&enable=S")->order("sort_order ASC")->fetch(true);
        $i = 0;
        $j = 0;
        foreach ($dad_menus as $dad) {
            $childrens = $this->find("parent_id=:id and enable=:enable", "id={$dad->id}&enable=S")->order("sort_order ASC")->fetch(true);
            if ($childrens) {
                foreach ($childrens as $children) {
                    $children_by_children = $this->find("parent_id=:id and enable=:enable", "id={$children->id}&enable=S")->order("sort_order ASC")->fetch(true);
                    if ($children_by_children) $childrens[$j]->children = $children_by_children;

                    $childrens[$j]->seo = 'page/' . $childrens[$j]->seo;
                    $j++;
                }
            }
            switch ($dad_menus[$i]->seo) {
                case $dad_menus[$i]->seo == "blog":
                    $dad_menus[$i]->seo = $dad_menus[$i]->seo;
                    break;
                default:
                    $dad_menus[$i]->seo = 'page/' . $dad_menus[$i]->seo;
                    $dad_menus[$i]->children = $childrens;
            }
            $i++;
        }
        return $dad_menus;
    }
}
