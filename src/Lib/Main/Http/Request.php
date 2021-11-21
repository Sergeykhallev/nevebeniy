<?php
namespace Src\Lib\Main\Http;

class Request
{
    public static function get($name)
    {
        return $_REQUEST[$name];
    }

    public static function isPost(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            return true;
        }

        return false;
    }

    public static function getPost($name): string
    {
        if (self::isPost()) {
            return $_POST[$name];
        }

        return '';
    }

    public function getPostList(): array
    {
        if (self::isPost()) {
            return $_POST;
        }

        return [];
    }

    public static function file($name)
    {
        return $_FILES[$name];
    }
}