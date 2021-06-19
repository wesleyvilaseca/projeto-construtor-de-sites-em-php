<?php

namespace app\request\admin\catalog;

use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_session\DataSession;

class BannerImageRequest
{
    use Validation;
    use Cripto;
    use DataSession;

    private $fillable = ['title', 'image'];

    public function save($request, $id = null)
    {
        $request['id'] = $id;
        foreach ($request as $requestkey => $requestitem) {
            foreach ($this->fillable as $item) {
                if ($requestkey == $item and !$requestitem) {
                    setmessage( ['tipo' => 'warning', 'msg' => 'Os campos com asterisco (*) são de preenchimento obrigatório']);
                    setdataform($request);
                    if ($id) {
                        $route =  URL_BASE . 'admin-catalog-bannerImage/edit/' . $request['banner_id'] . '/' . $id . '/';
                    } else {
                        $route = URL_BASE . 'admin-catalog-bannerImage/add/' . $request['banner_id'] . '/';
                    }
                    redirect($route);
                    exit;
                }
            }
        }
        return $request;
    }
}
