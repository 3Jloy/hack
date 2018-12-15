<?php

namespace App\Controller;

use App\Service\SecuredApplicationServiceInterface;
use Symfony\Component\HttpFoundation\Request;

class SecuredController extends BaseController
{
    private $service;

    public function __construct(SecuredApplicationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function invoke(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $response = $this->service->invoke($this->getUser(), $request);
        return $this->json($response);
    }
}