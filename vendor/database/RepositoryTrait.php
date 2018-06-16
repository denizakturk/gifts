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

}