<?php

namespace Gifts\Database;


trait RepositoryTrait
{

    public function find($id)
    {
        $table = constant($this->entity.'::TABLE');
        $sql = "SELECT * FROM {$table} WHERE id = :id";

        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);

        $pdoStatement->bindParam(':id', $id, \PDO::PARAM_INT);
        $pdoStatement->execute();

        return $pdoStatement->fetchObject($this->entity);
    }

    public function findBy(array $parameters)
    {
        $table = constant($this->entity.'::TABLE');
        $where = [];
        foreach ($parameters as $field => $value) {
            $where[] = "{$field} = :{$field}";
        }

        $whereClause = implode(' AND ', $where);
        $sql = "SELECT * FROM {$table} WHERE {$whereClause}";
        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);

        foreach ($parameters as $field => $value) {
            $pdoStatement->bindParam(":{$field}", $value);
        }

        $pdoStatement->execute();

        return $pdoStatement->fetchObject($this->entity);
    }

    public function findAll()
    {
        $table = constant($this->entity.'::TABLE');
        $sql = "SELECT * FROM {$table}";
        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);
        $pdoStatement->execute();

        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS, $this->entity);
    }

}