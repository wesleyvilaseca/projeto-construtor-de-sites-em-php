<?php
date_default_timezone_set('America/Belem');

define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "sistemaphp",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

define('TABLE_KEY', 'del_');

define('CONTROLLER_PADRAO', 'institucional\\common\\home');
define('METODO_PADRAO', 'index');
define('NAMESPACE_CONTROLLER', 'app\\controllers\\');

define('keytiny', 'pno1jzy3fokxrq842muonq3jfelg0kv5blqeryq4qxob95al');
define('URL_BASE', 'http://localhost/sistemaphp/');

#recaptchav2
define('SITE_KEY', '6LeCjroaAAAAAIZf_ByTo2gXDRqrKQv-6qQAWqN1');
define('SECRET_KEY', '6LeCjroaAAAAAFCIrrfSX6h9E-Lu8ZZY2nb67DVe');


# tinymce with filemanager and file manager stanalone
define('FILEMANAGER', [
    'PLUGIN_TINY_FILEMANAGER'   => URL_BASE . 'assets/adm/vendor/managerfile/tinymce/plugins/responsivefilemanager/plugin.min.js',
    'PLUGIN_FILEMANAGER'        => URL_BASE . 'assets/adm/vendor/managerfile/filemanager/plugin.min.js',
    'EXTERNAL_FILEMAGER_PATH'   => URL_BASE . 'assets/adm/vendor/managerfile/filemanager/',
    'TEMPLATES'                 => URL_BASE . 'assets/adm/vendor/tinymce/templatelist.php',
    'UPLOAD_DIR'                => '/sistemaphp/assets/adm/img/images/',
    'CURRENT_PATH'              => '../../../img/images/',
    'THUMBS_BASE_PATH'          => '../../../img/thumbs/',
    'THUMBS_UPLOAD_DIR'         => '../../../img/thumbs/',
    'TEMPLATELIST'              => URL_BASE . 'assets/adm/vendor/tinymce/templates/',
    'DIALOG'                    => URL_BASE . 'assets/adm/vendor/managerfile/filemanager/dialog.php?relative_url=1&type=0&'/*field_id=image-input*/
]);

define('EM_MANUTENCAO', 0);
