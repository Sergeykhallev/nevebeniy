<?php
namespace Src\Lib\Main\DB\SQL\Traits;

trait Checker
{
    /**
     * Проверяет доступность SELECT параметров
     * @param array $selects
     * @param $filliable
     * @return bool
     */
    protected function checkSelectParams(array $selects, $filliable): bool
    {
        if ($selects !== ['*']) {
            foreach ($selects as $select)
            {
                if (array_search($select, $filliable)) {
                    continue;
                }
                $this->errorField = strval($select);
                return false;
            }
            return true;
        }
        return true;
    }

    /**
     * Проверяет доступность WHERE параметров
     * @param $whereField
     * @param $filliable
     * @return bool
     */
    protected function checkWhereParams($whereField, $filliable): bool
    {
        if (array_search(strtolower($whereField), $filliable)) {
            return true;
        }
        $this->errorField = strval($whereField);
        return false;
    }

    /**
     * Проверяет является ли параметр последний в массиве
     * @param $param
     * @param array $array
     * @return bool
     */
    protected function isLastParam($param, array $array): bool
    {
        if (array_key_last($array) == $param) {
            return true;
        }
        return false;
    }
}