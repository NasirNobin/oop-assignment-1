<?php

namespace App\Managers;

use App\Contracts\FFmpegSriptContract;

abstract class FFmpegScript extends Script implements FFmpegSriptContract
{
    public function getFFmpegPath()
    {
        return '/usr/local/bin/ffmpeg';
    }
}