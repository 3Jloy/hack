<?php

namespace App\Controller;

use App\Service\ApplicationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecuredController extends BaseController
{
    private $service;

    public function __construct(ApplicationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function invoke(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $response = $this->service->invoke($request);
        return $this->json($response);
    }
}