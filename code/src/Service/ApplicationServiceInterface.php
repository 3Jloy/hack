<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface ApplicationServiceInterface
{
    /**
     * @param Request $request
     * @return \App\Response\BaseResponse;
     */
    public function invoke(Request $request);
}