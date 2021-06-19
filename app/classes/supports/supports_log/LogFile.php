<?php

namespace app\classes\supports\supports_log;

trait LogFile
{
    public static function setlog($msg, $req = null)
    {
        $arquivo  = fopen("log.txt", "a");
        fwrite($arquivo, $msg . "\n");
        
        if ($req)
            fwrite($arquivo, $req . "\n");

        fclose($arquivo);
    }

    public static function clear(){
        return file_put_contents("log.txt", "");
    }
}
