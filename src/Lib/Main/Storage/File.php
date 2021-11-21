<?php
namespace Src\Lib\Main\Storage;

class File
{
    public function put($filename, $data): void
    {
        file_put_contents($filename, $data . "\r\n", FILE_APPEND);
    }

    public function has($filename): bool
    {
        if (file_exists($filename)) {
            return true;
        }

        return false;
    }
}