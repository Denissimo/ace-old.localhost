<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Webmozart\Assert\Assert;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;

class ApiUserController extends AbstractController
{

    #[Route('/api/user', name: 'app_api_user')]
    public function index(): Response
    {
        return $this->render('api_user/index.html.twig', [
            'controller_name' => 'ApiUserController',
        ]);
    }

    public function getUserByUsername(string $username, UserRepository $userRepository): JsonResponse
    {
        return $this->json(
            $userRepository->findOneBy(['username' => $username]),
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );
    }

    public function addEmail(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $email = $request->getPayload()->get('email');
//        $user->addUserEmail();


        return $this->json([]);
    }
}
