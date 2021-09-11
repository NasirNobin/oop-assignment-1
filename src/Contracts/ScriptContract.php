<?php

namespace App\Contracts;

interface ScriptContract
{
    public function getUserName();

    public function getWorkingDirectoty();

    public function getScript();

    public function getPreparedScript();

    public function getTimeOut();

    public function handleOuput($process, $type, $buffer);
}
