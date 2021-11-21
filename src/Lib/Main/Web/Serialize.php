<?php
namespace Src\Lib\Main\Web;

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