<?php
namespace Src\Lib\Main\Http;

use Src\Lib\Main\Storage\File;

class Logger
{
    public function __construct()
    {
        $this->path = $_SERVER['DOCUMENT_ROOT'] . '/logs.txt';
        $this->file = new File();
    }

    public function info($data)
    {
        $this->file->put($this->path, $data);
    }
}