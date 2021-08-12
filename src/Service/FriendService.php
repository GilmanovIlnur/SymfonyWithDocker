<?php


namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FriendService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(User $user, User $current)
    {
        $current->addMyFriends($user);
        $this->entityManager->flush();
    }

    public function remove(User $user, User $current)
    {
        $current->removeMyFriend($user);
        $this->entityManager->flush();
    }
}