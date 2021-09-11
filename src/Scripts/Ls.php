<?php

namespace App\Scripts;

use App\Managers\Script;

class Ls extends Script
{
    private $workingDirectory;

    public function __construct($workingDirectory)
    {
        $this->workingDirectory = $workingDirectory;
    }

    public function getWorkingDirectoty()
    {
        return $this->workingDirectory;
    }

    public function getScript()
    {
        return 'ls -lah';
    }

    public function getTimeOut()
    {
        return 2;
    }
}