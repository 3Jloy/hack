<?php

namespace App\Service;

use App\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;

interface SecuredApplicationServiceInterface
{
    /**
     * @param User $user
     * @param Request $request
     * @return \App\Response\BaseResponse;
     */
    public function invoke(User $user, Request $request);
}