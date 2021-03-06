<?php

use App\Runner;
use App\Scripts\Deployment;
use App\Scripts\Ls;
use App\Scripts\ResizeVideo;
use App\Scripts\Sleep;

include "vendor/autoload.php";

// this is a simple script, that can sleep for specific seocnds
(new Runner(new Sleep(5)))->run();

// this can run the command to list files form a directory
(new Runner(new Ls('/tmp')))->run();

// resize a video to given ratio with ffmpeg
(new Runner(new ResizeVideo('/tmp/v.mp4', 640, 360, '/tmp/v-resied.mp4')))->run();

// run deployment script into a specific server by ssh
(new Runner(new Deployment('123.123.123.123', 'root')))->run();