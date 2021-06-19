<?php

namespace app\core;

use app\classes\supports\supports_apirequest\PullApi;
use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_session\DataSession;
use app\classes\supports\supports_log\LogFile;
use app\classes\supports\supports_libsjs\LibsJs;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_loadclass\LoadClass;

abstract class Controller
{
    use Validation;
    use LogFile;
    use LibsJs;
    use DataSession;
    use Cripto;
    use pullApi;

    protected function renderView(string $viewName, array $params = array())
    {
        $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader("app/views/"));
        $twig->addGlobal('URL_BASE', URL_BASE);
        $twig->addGlobal('URL_BASE_IMAGE', FILEMANAGER['UPLOAD_DIR']);
        $twig->addGlobal('DIALOG', FILEMANAGER['DIALOG'] . 'field_id=');
        $params['msg'] = getmessage();
        echo $twig->render($viewName . '.twig', $params);

        unset($_SESSION['msg']);
    }

    protected function loadView(string $viewName, array $params = array())
    {
        $menuid = explode(URL_BASE, geturl());
        array_shift($menuid);
        $menuid = explode('/', $menuid[0]);

        $twig = new \Twig\Environment(new \Twig\Loader\FilesystemLoader("app/views/"));
        $twig->addGlobal('URL_BASE', URL_BASE);
        $twig->addGlobal('current_menuid', $menuid[0]);
        $twig->addGlobal('URL_BASE_IMAGE', FILEMANAGER['UPLOAD_DIR']);
        $twig->addGlobal('DIALOG', FILEMANAGER['DIALOG'] . 'field_id=');
        $params['msg'] = getmessage();
        return $twig->render($viewName . '.twig', $params);
    }

    protected function load()
    {
        return new LoadClass;
    }
}
