<?php
namespace Src\Lib\Main\Web\Http;

use Src\Lib\Main\Web\Serialize;

class HttpResponse implements Response
{
    use Serialize;

    const RESPONSE_OK = 200;
    const RESPONSE_BAD_REQUEST = 400;
    const RESPONSE_UNAUTHORIZED = 401;
    const RESPONSE_FORBIDDEN = 403;

    public function sendJSONResponse(array $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo $this->toJson($data);
    }

    public function setCode($code): Response
    {
        http_response_code($code);
        return $this;
    }

    public function redirect($url, $code)
    {
        header('Location: ' . $url, true, $code);
    }
}