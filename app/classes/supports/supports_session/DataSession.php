<?php

namespace app\classes\supports\supports_session;

use app\classes\supports\supports_cripto\Cripto;

trait DataSession
{
    use Cripto;

    public function setSession($val, $key)
    {
        setcookie($key, $this->encrypt(json_encode($val)),  time() + (86400 * 30), "/");
    }

    public function getSession($key = 'admin')
    {
        if ($key == 'admin') {
            if (isset($_COOKIE[$key])) {
                $rec = json_decode($this->decrypt($_COOKIE[$key]));
                if (!$rec->email and !$rec->id) {
                    $this->sessionDestroi('admin', true);
                }
                return $rec;
            } else {
                header("Location: " . URL_BASE  . 'admin');
            }
        } else {
            if (isset($_COOKIE[$key])) {
                $rec = json_decode($this->decrypt($_COOKIE[$key]));
                return $rec;
            }
        }
    }

    public function sessionDestroi($key, $redirect = null)
    {
        setcookie($key, null, -1, '/');
        if ($redirect)
            header("Location: " . $redirect);
    }
}
