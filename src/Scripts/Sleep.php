<?php

namespace App\Scripts;

use App\Script;

class Sleep extends Script
{
    private int $sleepTimeInSeconds;

    public function __construct(int $sleepTimeInSeconds)
    {
        $this->sleepTimeInSeconds = $sleepTimeInSeconds;
    }

    public function getScript()
    {
        return sprintf("sleep %s", $this->sleepTimeInSeconds);
    }

    public function getTimeOut()
    {
        return $this->sleepTimeInSeconds + 5;
    }
}