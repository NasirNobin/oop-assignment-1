<?php

namespace App;

use App\Contracts\RemoteScriptContract;
use App\Contracts\ScriptContract;
use Symfony\Component\Process\Process;

class Runner
{
    /** * @var ScriptContract */
    private ScriptContract $script;

    /** @var Process */
    private Process $process;

    public function __construct(ScriptContract $script)
    {
        $this->script = $script;
    }

    public function run()
    {
        $this->process = Process::fromShellCommandline($this->script->getPreparedScript());

        $this->process->setTimeout($this->script->getTimeOut());

        $this->process->setWorkingDirectory($this->script->getWorkingDirectoty());

        $this->process->run(function ($type, $buffer) {
            $this->script->handleOuput($this->process, $type, $buffer);
        });
    }
}