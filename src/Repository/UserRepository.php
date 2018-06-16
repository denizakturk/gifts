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
}