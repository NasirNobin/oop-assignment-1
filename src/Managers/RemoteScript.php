<?php

namespace App\Managers;

use App\Contracts\RemoteScriptContract;
use Symfony\Component\Process\Process;

abstract class RemoteScript extends Script implements RemoteScriptContract
{
    /** @var Process */
    private $process;

    protected $remoteUser;
    protected $ipAddress;

    public function run()
    {
        $this->process = Process::fromShellCommandline(
            $this->sshInto(
                $this->remoteUser,
                $this->ipAddress,
                $this->getScript()
            )
        );

        $this->process->setTimeout($this->getTimeOut());
        $this->process->setWorkingDirectory($this->getWorkingDirectoty());

        $this->process->run(function ($type, $buffer) {
            $this->handleOuput($this->process, $type, $buffer);
        });
    }

    private function sshInto($user, $ip, $script)
    {
        return 'ssh -o "UserKnownHostsFile=/dev/null" -o "StrictHostKeyChecking=no" -i /home/root/id_rsa'.
            $user.'@'.$ip.' /bin/bash <<\'EOT\''.PHP_EOL.$script.PHP_EOL.'EOT';
    }
}