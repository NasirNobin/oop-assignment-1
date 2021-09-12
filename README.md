# PHP Script Runner

This package provides a clean interface to create and run terminal commands with PHP. It can run scripts both on local and remote (ssh) servers.

## Defining Script
```PHP
class Ls extends Script
{
    private $workingDirectory;

    public function __construct($workingDirectory)
    {
        $this->workingDirectory = $workingDirectory;
    }

    public function getWorkingDirectoty()
    {
        return $this->workingDirectory;
    }

    public function getScript()
    {
        return 'ls -lah';
    }

    public function getTimeOut()
    {
        return 2;
    }
}
```


## Defining a Remote Script 
```PHP 
class Deployment extends RemoteScript
{
    public function getScript()
    {
        return "
            git pull origin master
            composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev
            npm install && npm run production
        ";
    }

    public function getTimeOut()
    {
        return 600;
    }
}
```

## Defining a FFmpeg Script
```PHP
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
```

More Example Scripts Available at `/src/Scripts/`


## Invoking the scripts:

```PHP
// this is a simple script, that can sleep for specific seocnds
(new Runner(new Sleep(5)))->run();

// this can run the command to list files form a directory
(new Runner(new Ls('/tmp')))->run();

// resize a video to given ratio with ffmpeg
(new Runner(new ResizeVideo('/tmp/v.mp4', 640, 360, '/tmp/v-resied.mp4')))->run();

// run deployment script into a specific server by ssh
(new Runner(new Deployment('123.123.123.123', 'root')))->run();
```


## TODO: 
- [ ] Implement `RunInBackground` interface, that would be able to run any types of script in background
