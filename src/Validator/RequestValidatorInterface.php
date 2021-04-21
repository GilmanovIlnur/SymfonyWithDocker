<?php


namespace App\Validator;


use Symfony\Component\HttpFoundation\Request;

interface RequestValidatorInterface
{
    public function validate(Request $request);
}