<?php
namespace Src\Lib\Main\DB\SQL;

interface Builder
{
    public static function query(): Builder;
    public function where($field, $value): Builder;
    public function setSelect(array $select): Builder;
    public function fetch(): array;
}