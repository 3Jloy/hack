<?php

namespace App\Infrastructure\Storage;

interface SmsCodeStorageInterface
{
    /**
     * @param string $phone
     * @param string $code
     * @return void
     */
    public function set(string $phone, string $code);

    /**
     * @param string $phone
     * @return string
     */
    public function get(string $phone):string;
}