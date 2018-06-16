<?php


namespace Gifts\Database;


class EntityManager
{
    public $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

}