<?php


namespace App\Repository;


use Gifts\Database\EntityManager;
use Gifts\Database\RepositoryTrait;
use Gifts\Security\User;

class UserRepository
{

    use RepositoryTrait;

    protected $entity;

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entity = User::class;
        $this->entityManager = $entityManager;
    }

    public function getGiftSendableUser($authUserId)
    {
        $sql = "SELECT * FROM user WHERE id != :authUserId";

        /** @var \PDOStatement $pdoStatement */
        $pdoStatement = $this->entityManager->connection->prepare($sql);

        $pdoStatement->bindParam(':authUserId', $authUserId);

        $pdoStatement->execute();

        return $pdoStatement->fetchAll(\PDO::FETCH_CLASS, $this->entity);
    }
}