<?php


namespace App\Repository;


use App\Entity\Gift;
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
}