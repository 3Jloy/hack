<?php

namespace App\Security\Validator;

class SmsCodeValidator implements ValidatorInterface
{
    /**
     * @inheritdoc
     */
    public function isEqual($firstValue, $secondValue): bool
    {
        return $firstValue === $secondValue;
    }
}