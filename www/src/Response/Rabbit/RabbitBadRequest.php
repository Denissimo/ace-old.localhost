<?php

namespace App\Response\Rabbit;

use Exception;

class RabbitBadRequest extends Exception
{
    public $code = 400;

    public $message = 'Bad request';
}