<?php

namespace App\Controller;

use ApiPlatform\Metadata\ApiProperty;
use App\Repository\TestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use ApiPlatform\Doctrine\Orm\Paginator;

#[AsController]
class TestLoadController extends AbstractController
{
    public function __invoke(Request $request, TestRepository $testRepository): Paginator
    {
        $page = (int) $request->query->get('page', 1);
        return $testRepository->loadTests($page);
    }

    public function getDummy(): JsonResponse
    {
        return new JsonResponse(['asdf' => 'qwerty']);
    }

    public function getTests(TestRepository $testRepository, int $number = 0): JsonResponse
    {
        $res = $testRepository->getTests($number);

        return new JsonResponse($res);
    }
}
