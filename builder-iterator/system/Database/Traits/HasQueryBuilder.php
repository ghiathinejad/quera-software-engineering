<?php

namespace System\Database\Traits;


use System\Database\DBConnection\DBConnection;

trait HasQueryBuilder
{
    private $sql = "";
    protected $where = [];
    private $values = [];
    private $bindValues = [];

    protected function setSql($query)
    {
        $this->sql = $query;
    }

    protected function getSql()
    {
        return $this->sql;
    }

    protected function resetSql()
    {
        $this->sql = '';
    }

    protected function setWhere($operator, $condition)
    {
        $array = ['operator' => $operator, 'condition' => $condition];
        array_push($this->where, $array);
    }

    protected function resetWhere()
    {
        $this->where = [];
    }

    protected function addValue($attribute, $value)
    {
        $this->values[$attribute] = $value;
        array_push($this->bindValues, $value);
    }

    protected function removeValues()
    {
        $this->values = [];
        $this->bindValues = [];
    }

    protected function resetQuery()
    {
        $this->resetSql();
        $this->resetWhere();
        $this->removeValues();
    }

    protected function executeQuery()
    {
        $query = "";
        $query .= $this->sql;

        if (!empty($this->where)) {
            $whereString = "";
            foreach ($this->where as $where) {
                $whereString == "" ? $whereString .= $where['condition'] : $whereString .= ' ' . $where['operator'] . ' ' . $where['condition'];
            }
            $query .= " WHERE " . $whereString;
        }

        $query .= ';';
        $pdoInstance = DBConnection::getDBConnectionInstance();

        $statement = $pdoInstance->prepare($query);

        if (sizeof($this->bindValues) > sizeof($this->values)) {
            sizeof($this->bindValues) > 0 ? $statement->execute($this->bindValues) : $statement->execute();
        } else {
            sizeof($this->values) > 0 ? $statement->execute(array_values($this->values)) : $statement->execute();
        }
        return $statement;
    }

    protected function getTableName()
    {
        return '`' . $this->table . '`';
    }

    protected function getAttributeName($attribute)
    {
        return '`' . $this->table . '`.`' . $attribute . '`';
    }
}
