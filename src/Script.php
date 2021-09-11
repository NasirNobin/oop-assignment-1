<?php

namespace App;

use App\Contracts\ScriptContract;
use Symfony\Component\Process\Process;

abstract class Script implements ScriptContract
{
    public function getUserName()
    {
        return 'root';
    }

    public function getWorkingDirectoty()
    {
        return '/tmp/';
    }

    public function handleOuput($process, $type, $buffer)
    {
        echo $buffer.PHP_EOL;
    }

    public function getPreparedScript()
    {
        return $this->getScript(); // no formatting by default
    }
}