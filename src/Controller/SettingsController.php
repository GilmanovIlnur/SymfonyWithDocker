<?php


namespace App\Controller;


use App\Validator\PasswordChange\PasswordChangeValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SettingsController extends AbstractController
{
    private $changePasswordValidator;

    private $passwordEncoder;

    public function __construct(PasswordChangeValidator $changePasswordValidator, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->changePasswordValidator = $changePasswordValidator;
        $this->passwordEncoder = $passwordEncoder;
    }
    /**
     * @Route("settings", name="settings")
     */
    public function settings()
    {
        return $this->render('settings.html.twig');
    }

    /**
     * @Route("changePassword", name="changePassword")
     * @return Response
     */
    public function changePassword(Request $request)
    {
        $errors = null;
        if ($request->getMethod() === 'POST') {
            $this->changePasswordValidator->validate($request);
            if (count($this->changePasswordValidator->getErrors()) > 0) {
                $errors = implode(', ', $this->changePasswordValidator->getErrors());
            } else {
                $user = $this->getUser();
                $user->setPassword($this->passwordEncoder->encodePassword($user, $request->get('password1')));
                $this->getDoctrine()->getManager()->persist($user);
                $this->getDoctrine()->getManager()->flush();
            }
        }
        return $this->render('change_password.html.twig', ['errors' => $errors]);
    }
}