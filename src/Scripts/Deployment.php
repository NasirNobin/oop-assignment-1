<?php

namespace App\Scripts;

use App\RemoteScript;

class Deployment extends RemoteScript
{
    public function getScript()
    {
        return $this->withSsh("
            git pull origin master
            composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
            npm install && npm run production
        ");
    }

    public function getTimeOut()
    {
        return 600;
    }
}