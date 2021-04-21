<?php


namespace App\Service;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService
{
    private $passwordEncoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }
    public function saveUser($userName, $password)
    {
        $user = new User();
        $user
            ->setPassword($this->passwordEncoder->encodePassword($user, $password))
            ->setUsername($userName);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}