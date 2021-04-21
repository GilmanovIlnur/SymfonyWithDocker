<?php


namespace App\Validator\PasswordChange;


use App\Validator\AbstractRequestValidator;
use App\Validator\Registration\PasswordValidator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class PasswordChangeValidator extends AbstractRequestValidator
{
    private $security;
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, Security $security)
    {
        $this->security = $security;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function getValidators(): array
    {
        return [
            new PasswordValidator(),
            new OldPasswordValidator($this->security, $this->passwordEncoder)
        ];
    }
}
