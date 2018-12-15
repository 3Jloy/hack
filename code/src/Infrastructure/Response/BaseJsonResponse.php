<?php

namespace App\Infrastructure\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseJsonResponse extends JsonResponse
{
    public function __construct($data = null, int $status = 200, array $headers = array(), bool $json = false)
    {
        $this->encodingOptions = $this->encodingOptions | JSON_UNESCAPED_UNICODE;
        $headers['content-type'][] = 'application/json; charset=utf-8';
        parent::__construct($data, $status, $headers, $json);
    }
}