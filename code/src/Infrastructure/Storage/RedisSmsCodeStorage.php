<?php

namespace App\Infrastructure\Storage;

use Predis\ClientInterface;

class RedisSmsCodeStorage implements SmsCodeStorageInterface
{
    /** @var ClientInterface  */
    private $redis;

    public function __construct(ClientInterface $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @inheritDoc
     */
    public function set(string $phone, string $code)
    {
        $this->redis->set($this->generateKey($phone), $code);
    }

    /**
     * @inheritDoc
     */
    public function get(string $phone): string
    {
        return $this->redis->get($this->generateKey($phone)) ?: '';
    }

    /**
     * @param string $phone
     * @return string
     */
    private function generateKey(string $phone)
    {
        return sprintf('sms_code_%s', $phone);
    }

}