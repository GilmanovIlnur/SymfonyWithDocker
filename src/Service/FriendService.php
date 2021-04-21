<?php


namespace App\Service;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FriendService extends AbstractEntityService
{

    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        TokenStorageInterface $tokenStorage)
    {
        parent::__construct($entityManager, $tokenStorage);
        $this->userRepository = $userRepository;
    }
    public function add($id)
    {
        $this->getUser()->addMyFriends($this->userRepository->findOneBy(['id' => $id]));
        $this->entityManager->flush();
    }

    public function remove($id)
    {
        $this->getUser()->removeMyFriend($this->userRepository->findOneBy(['id' => $id]));
        $this->entityManager->flush();
    }
}