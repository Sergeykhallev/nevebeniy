<?php
namespace Src\Lib\Main\DB;

abstract class SQLBuilder
{
    private $mysql;

    public $table;

    public $sqlParams;

    public $result;

    public function setSelect(array $select): self
    {
        $this->sqlParams['select'] = $select;
        return $this;
    }

    public function where($field, $value): self
    {
        $this->sqlParams['where'][$field] = $value;
        return $this;
    }

    public function fetch()
    {
        $this->genericSQL();
        return $this->mysql->query($this->result)->fetch_array();
    }

    private function genericSQL(): void
    {
        $this->genericSelect();
        $this->genericWhere();

        $this->result .= ';';
    }

    private function genericWhere(): void
    {
        $this->result .= ' WHERE ';
        $i = 0;
        foreach ($this->sqlParams['where'] as $field => $value)
        {
            if (count($this->sqlParams['where'])-1 != $i) {
                $this->result .= "$field = $value AND";
                continue;
            }
        $this->result .= " $field = $value";
        $i++;
        }
    }

    private function genericSelect(): void
    {
        $this->result = 'SELECT ';
        foreach ($this->sqlParams['select'] as $key => $param)
        {
            if (count($this->sqlParams['select'])-1 != $key) {
                $this->result .= $param.", ";
                continue;
            }

            $this->result .= $param;
        }

        $this->result .= " FROM " . $this->table;
    }

    public static function query(): self
    {
        return new static();
    }

    private function __construct()
    {
        $this->mysql = DB::connect();
        $this->sqlParams = [
            'select' => null,
            'where' => null
        ];
    }
}