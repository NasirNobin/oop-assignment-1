<?php

namespace App\Scripts;

use App\Managers\FFmpegScript;

class ResizeVideo extends FFmpegScript
{
    private $inputFilePath;
    private $outputFilePath;
    private $height;
    private $width;

    public function __construct($inputFilePath, $outputFilePath, $width, $height)
    {
        $this->inputFilePath = $inputFilePath;
        $this->outputFilePath = $outputFilePath;
        $this->width = $width;
        $this->height = $height;
    }

    public function getScript()
    {
        return sprintf("%s -i %s -vf scale=%s:%s -y %s",
            $this->getFFmpegPath(),
            $this->inputFilePath,
            $this->width,
            $this->height,
            $this->outputFilePath
        );
    }

    public function getTimeOut()
    {
        return 600;
    }
}