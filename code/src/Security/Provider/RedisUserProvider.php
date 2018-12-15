<?php

namespace App\Security\Provider;

use App\Security\Entity\User;
use Predis\ClientInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class RedisUserProvider implements UserProviderInterface
{
    private $redis;

    public function __construct(ClientInterface $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @inheritDoc
     */
    public function loadUserByUsername($username)
    {
        if ($phone = $this->redis->get($username)) {
            return new User($phone, $username);
        }

        throw new UsernameNotFoundException('Пользователь не авторизован');
    }

    /**
     * @inheritDoc
     */
    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    /**
     * @inheritDoc
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }

}