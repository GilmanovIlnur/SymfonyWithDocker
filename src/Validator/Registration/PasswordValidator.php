<?php


namespace App\Validator\Registration;


use App\Validator\RequestValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

class PasswordValidator implements RequestValidatorInterface
{
    /**
     * @param Request $request
     * @return string|null
     */
    public function validate(Request $request)
    {
        if ($request->get('password1') !== $request->get('password2')) {
            return "Password not equals";
        }
        return null;
    }
}