<?php


namespace App\Controller;


use App\Service\UserService;
use App\Validator\Registration\RegistrationValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    private $validator;

    private $userService;

    public function __construct(RegistrationValidator $validator, UserService $userService)
    {
        $this->validator = $validator;
        $this->userService = $userService;
    }
    /**
     * * @Route("/registration", name="registration")
     */
    public function registration()
    {
        return $this->render('security/registration.html.twig',
        [
            'errors' => ''
        ]);
    }

    /**
     * @Route("/registrate", name="registrate")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function registrate(Request $request)
    {
        $this->validator->validate($request);
        if (count($this->validator->getErrors()) > 0) {
            return $this->render('security/registration.html.twig',
                [
                    'errors' => implode(', ', $this->validator->getErrors())
                ]);
        }
        $this->userService->saveUser($request->get('username'), $request->get('password1'));

        return $this->redirectToRoute('app_login');
    }
}