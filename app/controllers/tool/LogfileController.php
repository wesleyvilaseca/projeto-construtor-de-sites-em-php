<?php

namespace app\controllers\tool;

use app\core\Controller;
use app\classes\supports\supports_log\LogFile;

class LogfileController extends Controller
{
    use LogFile;

    public function clear_log()
    {
        self::clear();
    }
}
