<?php

namespace App\Controller;

use App\Infrastructure\Response\BaseJsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    protected function json($data, $status = 200, $headers = array(), $context = array())
    {
        return new BaseJsonResponse($data, $status, $headers);
    }
}