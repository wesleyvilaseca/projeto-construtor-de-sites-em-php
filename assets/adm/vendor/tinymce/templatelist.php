<?php
include '../../../../config/config.php';

$list = [
    (object)["title"=> "email adress", "description"=> "email adress", "url" => FILEMANAGER['TEMPLATELIST'] .  "teste.html"],
    (object)["title"=> "Modelo bloco texto 1", "description"=> "Modelo bloco texto 1", "url" => FILEMANAGER['TEMPLATELIST'] .  "bloco_text1.html"]
];

echo json_encode($list);