<?php

namespace App\Security\Provider;

use App\Security\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class FileUserProvider implements UserProviderInterface
{
    public function loadUserByUsername($userId)
    {
        return new User($userId, 'testApiKey');
    }

    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass($class)
    {
        return User::class === $class;
    }

}