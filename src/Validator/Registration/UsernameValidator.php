<?php


namespace App\Validator\Registration;


use App\Repository\UserRepository;
use App\Validator\RequestValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

class UsernameValidator implements RequestValidatorInterface
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     * @return string|null
     */
    public function validate(Request $request)
    {
        $user = $this->userRepository->findOneBy(['username' => $request->get('username')]);
        if ($user !== null) {
            return "User exists";
        }
        return null;
    }
}