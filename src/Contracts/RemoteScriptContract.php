<?php

namespace App\Contracts;

interface RemoteScriptContract
{
    public function getRemoteUser();

    public function ipAddress();
}