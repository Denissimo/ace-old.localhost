<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

class CatController
{
    public function __invoke()
    {
        return new JsonResponse(['cat' => 'invoke']);
    }


    public function cat(): JsonResponse
    {
        return new JsonResponse(['cat' => 'created']);
    }

    public function catPatch(): JsonResponse
    {
        return new JsonResponse(['cat' => 'patches']);
    }
}