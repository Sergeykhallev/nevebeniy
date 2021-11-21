<?php
namespace Src\Lib\Main\Web;

use JetBrains\PhpStorm\Pure;
use Src\Lib\Main\Web\Http\HttpRequest;
use Src\Lib\Main\Web\Http\HttpResponse;
use Src\Lib\Main\Web\Http\Request;
use Src\Lib\Main\Web\Http\Response;

class Http
{
    #[Pure] public static function getRequest(): Request
    {
        return new HttpRequest();
    }

    #[Pure] public static function getResponse(): Response
    {
        return new HttpResponse();
    }
}