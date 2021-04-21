<?php


namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\AbstractEntityService;
use App\Service\FriendService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class FriendsController extends AbstractController
{
    /**
     * @var FriendService $friendService
     */
    private $friendService;

    private $userRepository;

    public function __construct(UserRepository $userRepository, FriendService $friendService)
    {
        $this->userRepository = $userRepository;
        $this->friendService = $friendService;
    }

    /**
     * @Route("friends/{userId}", name="friends")
     */
    public function friends($userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        return $this->render('users/friends.html.twig', [
            'title' => 'Мои друзья',
            'friends' => $user->getMyFriends(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("friendsWithMe/{userId}", name="friendsWithMe")
     */
    public function friendsWithMe($userId)
    {
        $user = $this->userRepository->findOneBy(['id' => $userId]);
        return $this->render('users/friends.html.twig', [
            'title' => 'Я в друзьях',
            'friends' => $user->getFriendsWithMe(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("addFriend/{userId}")
     * @param $userId
     * @return RedirectResponse
     */
    public function addFriend($userId): RedirectResponse
    {
        $this->friendService->add($userId);

        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("dropFriend/{userId}")
     */
    public function dropFriend($userId)
    {
        $this->friendService->remove($userId);

        return $this->redirectToRoute('profile');
    }
}