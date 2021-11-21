<?php
namespace Src\Lib\Main\Http;

trait Serialize
{
    public function toJson($result)
    {
        return json_encode($result);
    }

    public function toArray($result)
    {
        return json_decode($result);
    }
}