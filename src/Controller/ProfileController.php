<?php


namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ProfileController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }
    /**
     * @Route("/profile/{id}", name="profile")
     */
    public function profile($id = null)
    {
        $user = $id ? $this->userRepository->findOneBy(['id' => $id]) : $this->getUser();

        return $this->render('profile.html.twig', [
            'user' => $user
        ]);
    }
}