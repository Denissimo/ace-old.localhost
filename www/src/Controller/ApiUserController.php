<?php

namespace App\Controller;

use App\ApiRequest\UserEmailRequest;
use App\Entity\User;
use App\Entity\UserEmail;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
        $user = $userRepository->findOneBy(['username' => $username]);
        if (!$user instanceof UserInterface) {
            throw new BadRequestHttpException("User $username not found");
        }
        return $this->json($user);
    }

    public function addEmail(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        /** @var User $user */
        $user = $this->getUser();

//        $userEmailRequest = new UserEmailRequest($request);
        $inputBag = $request->getPayload();
        $userEmail = (new UserEmail())
            ->setUser($user)
            ->setEmail($inputBag->get('email'));

        $errors = $validator->validate($userEmail);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            throw new BadRequestHttpException($errorsString);
//            return new Response($errorsString);
        }

        $entityManager->persist($userEmail);
        $entityManager->flush();

        return $this->json($userEmail);
    }
}
