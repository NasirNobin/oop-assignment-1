<?php

namespace App;

use App\Contracts\RemoteScriptContract;
use Symfony\Component\Process\Process;

abstract class RemoteScript extends Script implements RemoteScriptContract
{
    protected $remoteUser;
    protected $ipAddress;

    public function __construct($ipAddress, $remoteUser = 'root')
    {
        $this->ipAddress = $ipAddress;
        $this->remoteUser = $remoteUser;
    }

    public function getRemoteUser()
    {
        return $this->remoteUser;
    }

    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    public function withSsh($script)
    {
        return 'ssh -o "UserKnownHostsFile=/dev/null" -o "StrictHostKeyChecking=no" -i /home/'.get_current_user().'/id_rsa'.
            $this->getRemoteUser().'@'.$this->getIpAddress().' /bin/bash <<\'EOT\''.PHP_EOL.$script.PHP_EOL.'EOT';
    }

    public function getPreparedScript()
    {
        return $this->withSsh($this->getScript());
    }
}