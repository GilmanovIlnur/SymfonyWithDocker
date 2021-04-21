<?php


namespace App\Validator;


use Symfony\Component\HttpFoundation\Request;

abstract class AbstractRequestValidator implements RequestValidatorInterface
{
    protected $errors = [];

    public function validate(Request $request)
    {
        foreach ($this->getValidators() as $validator) {
            if ($error = $validator->validate($request)){
                $this->addError($error);
            }
        }
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    protected function addError($error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return RequestValidatorInterface[]
     */
    abstract protected function getValidators(): array;
}