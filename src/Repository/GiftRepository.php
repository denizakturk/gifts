<?php


namespace App\Repository;


use App\Entity\Gift;
use App\Utility\Cache;
use App\Utility\Constants;
use Gifts\Database\EntityManager;
use Gifts\Database\RepositoryTrait;

class GiftRepository
{

    use RepositoryTrait;

    protected $entity;

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entity = Gift::class;
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        $cacheKey = Constants::ALL_GIFT_OBJECT;

        $result = Cache::get($cacheKey);

        if (empty($result)) {
            $sql = "SELECT * FROM gift";
            /** @var \PDOStatement $pdoStatement */
            $pdoStatement = $this->entityManager->connection->prepare($sql);
            $pdoStatement->execute();
            $result = $pdoStatement->fetchAll(\PDO::FETCH_CLASS, $this->entity);
            Cache::set($cacheKey, $result);
        }

        return $result;
    }
}