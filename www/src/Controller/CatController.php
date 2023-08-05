<?php

namespace App\Controller;

use App\Response\CatResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class CatController
{
    public function __invoke()
    {
        return new JsonResponse(['cat' => 'invoke']);
    }


    public function cat(): JsonResponse
    {
        $cat = new CatResponse();
//        return (new JsonResponse())->setJson(json_encode($cat));
        return (new JsonResponse())->setJson(json_encode(['a'=>'b']));
    }

    public function catPatch(): JsonResponse
    {
        return new JsonResponse(['cat' => 'patches']);
    }
}