<?php
namespace Src\Lib\Main\DB\SQL;

use Src\Lib\Main\DB\DB;
use mysqli;
use Src\Lib\Main\DB\SQL\Traits\Checker;
use Src\Lib\Main\DB\SQL\Traits\SQLData;

abstract class SQLBuilder implements Builder
{
    use Checker, SQLData;

    /**
     * Используемая таблица - задаётся в параметрах модели
     * @var string $table
     */
    public string $table;

    /**
     * Поля, доступные из модели для запроса в БД
     * @var array $filliable
     */
    public array $filliable;

    /**
     * Класс для запросов в БД
     * @var mysqli $mysql
     */
    private mysqli $mysql;

    /**
     * Передаваемые параметры запроса для билдера,
     * инициализируются в классе экземпляра после вызова методов
     * @var array|null[]
     */
    private array $sqlParams;

    /**
     * Полученный SQL запрос из использующихся методов
     * @var string $result
     */
    private string $result;

    /**
     * Поле которое вызвало исключение при проверке
     * @var string $errorField
     */
    private string $errorField;

    /**
     *
     * @return static
     */
    public static function query(): Builder
    {
        return new static();
    }

    private function __construct()
    {
        // лучше не делай так никогда
        if (!array_search('id', $this->filliable)) {
            $this->filliable[] = 'id';
        }

        $this->mysql = DB::connect();
        $this->sqlParams = [
            'select' => null,
            'where' => null
        ];
    }

    /**
     * Инициализирует массив [select] для построения SQL
     * @param array $select
     * @return $this
     * @throws SQLBuilderException
     */
    public function setSelect(array $select): Builder
    {
        if ($this->checkSelectParams($select, $this->filliable)) {
            $this->sqlParams['select'] = $select;
            return $this;
        } else {
            throw new SQLBuilderException("Field $this->errorField does not exist or is not available!");
        }
    }

    /**
     * Инициализирует массив [where] для построения SQL
     * @param $field
     * @param $value
     * @return $this
     * @throws SQLBuilderException
     */
    public function where($field, $value): Builder
    {
        if ($this->checkWhereParams($field, $this->filliable)) {
            $this->sqlParams['where'][$field] = $value;
            return $this;
        } else {
            throw new SQLBuilderException("Field $this->errorField field is not available!");
        }
    }

    /**
     * Возвращает результат запроса в виде ассоциативного массива
     * @return array
     */
    public function fetch(): array
    {
        $this->genericSQL();
        return $this->mysql->query($this->result)->fetch_assoc();
    }

    /**
     * Фасад методов для генерации SQL
     */
    private function genericSQL(): void
    {
        $this->genericSelect();

        if ($this->sqlParams['where']) {
            $this->genericWhere();
        }

        $this->result .= ';';
    }

    /**
     * Генерирует WHERE часть для SQL
     */
    private function genericWhere(): void
    {
        $this->result .= ' WHERE';
        $this->setWhereParams();
    }

    /**
     * Генерирует SELECT часть для SQL
     * @var string $this->table - значение берётся из параметров модельки
     */
    private function genericSelect(): void
    {
        $this->result = 'SELECT ';
        $this->setSelectParams();
        $this->result .= " FROM " . $this->table;
    }

    /**
     * Устанавливает WHERE параметры для SQL
     */
    private function setWhereParams()
    {
        foreach ($this->sqlParams['where'] as $field => $value)
        {
            $value = $this->toSQLDataFormat($value);
            if ($this->isLastParam($field, $this->sqlParams['where'])) {
                $this->result .= " $field = $value";
                break;
            } else {
                $this->result .= " $field = $value AND";
            }
        }
    }

    /**
     * Устанавливает SELECT параметры для SQL
     */
    private function setSelectParams()
    {
        if ($this->sqlParams['select'][0] == '*') {
            $this->result .= "*";
        } else {
            foreach ($this->sqlParams['select'] as $key => $param)
            {
                if ($this->isLastParam($key, $this->sqlParams['select'])) {
                    $this->result .= $param;
                    break;
                } else {
                    $this->result .= $param.", ";
                }
            }
        }
    }
}