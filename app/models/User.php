<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
    public function __construct()
    {
        parent::__construct('user', ['nome', 'email', 'senha', 'username', 'enable', 'enabled'], 'id', false);
    }
}
