<?php

namespace App\Security\Generator;

class SmsCodeGenerator implements SmsCodeGeneratorInterface
{
    /**
     * @inheritDoc
     */
    public function generateSmsCode(): string
    {
        return mt_rand(1000, 9999);
    }

}