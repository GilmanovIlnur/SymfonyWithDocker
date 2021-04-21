<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class TestController extends AbstractController
{
    /**
     * @Route("/", name="test")
     */
    public function test()
    {
        return $this->redirectToRoute("app_login");
    }
}