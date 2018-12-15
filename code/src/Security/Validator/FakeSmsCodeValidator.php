<?php

namespace App\Security\Validator;

class FakeSmsCodeValidator implements ValidatorInterface
{
    /**
     * @inheritdoc
     */
    public function isEqual($firstValue, $secondValue): bool
    {
        return true;
    }

}