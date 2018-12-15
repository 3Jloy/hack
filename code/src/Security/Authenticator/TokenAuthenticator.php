<?php

namespace App\Security\Authenticator;

use App\Infrastructure\Response\BaseJsonResponse;
use App\Response\BaseResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class TokenAuthenticator extends AbstractGuardAuthenticator
{
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new BaseJsonResponse(
            new BaseResponse([], Response::HTTP_UNAUTHORIZED, 'Необходима авторизация'),
            Response::HTTP_UNAUTHORIZED
        );
    }

    public function supports(Request $request)
    {
        return $request->headers->has('X-AUTH-TOKEN');
    }

    public function getCredentials(Request $request)
    {
        return $request->headers->get('X-AUTH-TOKEN');
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $apiKey = $credentials;

        if (null === $apiKey) {
            return null;
        }

        // if a User object, checkCredentials() is called
        return $userProvider->loadUserByUsername($apiKey);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return $credentials == $user->getPassword();
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = new BaseJsonResponse(
            new BaseResponse([], Response::HTTP_FORBIDDEN, 'Данные авторизации не верны'),
            Response::HTTP_FORBIDDEN,
            []
        );

        return $data;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return true;
    }

}