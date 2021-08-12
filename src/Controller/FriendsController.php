<?php


namespace App\Controller;

use App\Entity\User;
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

    public function __construct(FriendService $friendService)
    {
        $this->friendService = $friendService;
    }

    /**
     * @Route("friends/{id}", name="friends")
     */
    public function friends(User $user)
    {
        if ($this->getUser()->getId() === $user->getId()) {
            $title = 'Мои друзья';
        } else {
            $title = 'Друзья ' . $user->getUsername();
        }
        return $this->render('users/users.html.twig', [
            'title' => $title,
            'users' => $user->getMyFriends(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("friendsWithMe/{id}", name="friendsWithMe")
     */
    public function friendsWithMe(User $user)
    {
        if ($this->getUser()->getId() === $user->getId()) {
            $title = 'Я в друзьях';
        } else {
            $title = $user->getUsername() . ' в друзьях';
        }
        return $this->render('users/users.html.twig', [
            'title' => $title,
            'users' => $user->getFriendsWithMe(),
            'user' => $user,
        ]);
    }

    /**
     * @Route("addFriend/{id}")
     * @param User $user
     * @return RedirectResponse
     */
    public function addFriend(User $user): RedirectResponse
    {
        $this->friendService->add($user, $this->getUser());

        return $this->redirectToRoute('profile');
    }

    /**
     * @Route("dropFriend/{id}")
     * @param User $user
     * @return RedirectResponse
     */
    public function dropFriend(User $user)
    {
        $this->friendService->remove($user, $this->getUser());

        return $this->redirectToRoute('profile');
    }
}