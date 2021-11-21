<?php
namespace Src\Lib\Main\DB;

use mysqli;

class DB
{
    public mysqli $mysqli;

    private function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', 'root', 'serega');
    }

    public static function connect(): mysqli
    {
        $class = new static();
        return $class->mysqli;
    }
}