<?php

namespace App\Scripts;

use App\Managers\RemoteScript;

class Deployment extends RemoteScript
{
    public function getScript()
    {
        return "
            git pull origin master
            composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
            npm install && npm run production
        ";
    }

    public function getTimeOut()
    {
        return 600;
    }
}