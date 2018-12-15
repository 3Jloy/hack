<?php

namespace App\Response;

class BaseResponse
{
    /**
     * @var int
     */
    public $code;

    /**
     * @var string;
     */
    public $message;

    /**
     * @var mixed
     */
    public $result;

    public function __construct($result, int $code = 200, $message = 'Ok')
    {
        $this->code = $code;
        $this->message = $message;
        if (is_array($result) && empty($result)) {
            $this->result = new \stdClass();
        } else {
            $this->result = $result;
        }
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }
}