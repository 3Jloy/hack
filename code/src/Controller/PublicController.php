<?php

namespace App\Controller;

use App\Service\ApplicationServiceInterface;
use Symfony\Component\HttpFoundation\Request;

class PublicController extends BaseController
{
    private $service;

    public function __construct(ApplicationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function invoke(Request $request)
    {
        $response = $this->service->invoke($request);
        return $this->json($response, $response->getCode());
    }
}