<?php
namespace Src\Lib\Main\DB;

use Src\Lib\Main\DB\SQL\SQLBuilder;

abstract class Model extends SQLBuilder
{
    /**
     * Доступные поля из таблицы
     * @var array $filliable
     */
    public array $filliable;

    /**
     * Название таблицы
     * @var string $table
     */
    public string $table;
}