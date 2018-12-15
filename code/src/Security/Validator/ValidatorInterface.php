<?php

namespace App\Security\Validator;

interface ValidatorInterface
{
    /**
     * @param $firstValue
     * @param $secondValue
     * @return bool
     */
    public function isEqual($firstValue, $secondValue) : bool;
}