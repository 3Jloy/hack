<?php

namespace App\Security\Generator;

interface SmsCodeGeneratorInterface
{
    /**
     * @param string $phone
     * @return string
     */
    public function generateSmsCode(): string;
}