<?php

namespace app\request\admin\catalog;

use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_session\DataSession;

class ImageGalleryRequest
{
    use Validation;
    use Cripto;
    use DataSession;

    private $route = URL_BASE . 'admin-catalog-imageGallery/';
    private $fillable = ['image', 'tags'];

    public function save($request)
    {
        if (!$request['banner_id'])
            redirect(URL_BASE);

        foreach ($request as $key => $input) {
            foreach ($this->fillable as $index) {
                if ($key == $index and !$input) {
                    setmessage(['tipo' => 'warning', 'msg' => 'Os campos com asterisco (*) são de preenchimento obrigatório']);
                    setdataform($request);
                    redirect($this->route . 'add/' . $request['banner_id']);
                }
            }
        }

        return $request;
    }

    public function update($request)
    {
        return self::save($request);
    }
}
