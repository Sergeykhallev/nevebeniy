<?php
namespace Src\Lib\Main\Web\Http;

class HttpResponse implements Response
{
    const RESPONSE_OK = 200;
    const RESPONSE_BAD_REQUEST = 400;
    const RESPONSE_UNAUTHORIZED = 401;
    const RESPONSE_FORBIDDEN = 403;

    public function sendJSONResponse(array $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
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