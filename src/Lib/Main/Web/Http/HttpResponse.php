<?php
namespace Src\Lib\Main\Web\Http;

class HttpResponse implements Response
{
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