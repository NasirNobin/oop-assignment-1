<?php

namespace App\Managers;

use App\Contracts\ScriptContract;
use Symfony\Component\Process\Process;

abstract class Script implements ScriptContract
{
    /** @var Process */
    private $process;

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

    public function run()
    {
        $this->process = Process::fromShellCommandline($this->getScript());

        $this->process->setTimeout($this->getTimeOut());
        $this->process->setWorkingDirectory($this->getWorkingDirectoty());

        $this->process->run(function ($type, $buffer) {
            $this->handleOuput($this->process, $type, $buffer);
        });
    }
}