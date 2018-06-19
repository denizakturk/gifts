<?php


namespace App\Repository;


use App\Utility\Cache;
use App\Utility\Constants;
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
        $cacheKey = sprintf(Constants::SENDABLE_USER_CACHE_KEY, $authUserId);

        $result = Cache::get($cacheKey);

        if (empty($result)) {

            $sql = "SELECT * FROM user WHERE id != :authUserId";

            /** @var \PDOStatement $pdoStatement */
            $pdoStatement = $this->entityManager->connection->prepare($sql);

            $pdoStatement->bindParam(':authUserId', $authUserId);

            $pdoStatement->execute();
            $result = $pdoStatement->fetchAll(\PDO::FETCH_CLASS, $this->entity);

            Cache::set($cacheKey, $result);
        }

        return $result;
    }
}