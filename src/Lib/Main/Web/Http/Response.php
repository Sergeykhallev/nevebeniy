<?php
namespace Src\Lib\Main\Web\Http;

interface Response
{
    public function setCode($code): Response;
    public function sendJSONResponse(array $data);
    public function redirect($url, $code);

}