# PHP Script Runner

This package provides a clean interface to programmatically create and run terminal commands with PHP. It can run scripts both on local and remote (ssh) servers.

## Defining Script
```PHP

use App\Managers\Script;

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


## Defining a remote script 
```PHP 
use App\Managers\RemoteScript;

class Deployment extends RemoteScript
{
    public function __construct($ipAddress, $remoteUser = 'root')
    {
        $this->ipAddress = $ipAddress;
        $this->remoteUser = $remoteUser;
    }

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

More Example Scripts Available at `/src/Scripts/`



## Invoking the scripts:

```PHP
// this can run the command to list files form a directory
(new Ls('/tmp'))->run();

// this is a simple script, that can sleep for specific seocnds
(new Sleep(5))->run();

// resize a video to given ratio with ffmpeg
(new ResizeVideo('/tmp/v.mp4', 640, 360, '/tmp/v-resied.mp4'))->run();

// run deployment script into a specific remote server by ssh
(new Deployment('123.123.123.123', 'root'))->run();
```
