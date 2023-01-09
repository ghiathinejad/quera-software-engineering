<?php

namespace System\Database\Traits;

use System\Database\DBConnection\DBConnection;


trait HasCRUD
{

    protected function allMethod()
    {
        $this->setSql("SELECT * FROM " . $this->getTableName());
        $statement = $this->executeQuery();
        $data = $statement->fetchAll();
        $this->resetQuery();
        if ($data) {
            return $data;
        }

        return [];
    }

    protected function findMethod($id)
    {
        $this->setSql("SELECT * FROM " . $this->getTableName());

        $this->setWhere("AND", $this->getAttributeName($this->primaryKey) . " = ?");

        $this->addValue($this->primaryKey, $id);

        $statement = $this->executeQuery();

        $data = $statement->fetch();

        $this->setAllowedMethods(['update', 'delete', 'find']);

        $this->resetQuery();

        if ($data) {
            return $data;
        }
        return null;
    }

}

