<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class RandomRabbit
{
    public function __invoke()
    {
        return new JsonResponse(['rabbit' => 'invoke']);
    }

    public function rabbit(): JsonResponse
    {
        return new JsonResponse(['rabbit' => 'created']);
    }
}