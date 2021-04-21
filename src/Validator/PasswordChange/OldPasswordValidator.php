<?php


namespace App\Validator\PasswordChange;


use App\Validator\RequestValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class OldPasswordValidator implements RequestValidatorInterface
{
    private $security;
    private $passwordEncoder;

    public function __construct(Security $security, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
    }
    public function validate(Request $request)
    {
        $user = $this->security->getUser();
        if (!$this->passwordEncoder->isPasswordValid($user, $request->get('old_password'))) {
            return 'Wrong old password';
        }
        return null;
    }
}