<?php

namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class Helpers
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUser(int $userId)
    {
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $userId]);
        if ( is_null($user)) {
            return 0;
        }
        return $user;
    }

}