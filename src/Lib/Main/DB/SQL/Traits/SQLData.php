<?php
namespace Src\Lib\Main\DB\SQL\Traits;

trait SQLData
{
    /**
     * Приводит формат данных в нужный тип для SQL
     * @param $data
     * @return string
     */
    protected function toSQLDataFormat($data): string
    {
        if (intval($data)) {
            return $data;
        }

        return "'".$data."'";
    }
}