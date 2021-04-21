<?php


namespace App\Validator\Registration;


use App\Repository\UserRepository;
use App\Validator\AbstractRequestValidator;
use App\Validator\RequestValidatorInterface;

class RegistrationValidator extends AbstractRequestValidator
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return RequestValidatorInterface[]
     */
    protected function getValidators(): array
    {
        return [
            new UsernameValidator($this->userRepository),
            new PasswordValidator(),
        ];
    }
}