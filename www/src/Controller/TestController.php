<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(EntityManagerInterface $entityManager,UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $userName = str_shuffle('qwerty') . rand(100,999);
        $user->setUsername($userName)
            ->setRoles([])
            ->setPassword(
                $userPasswordHasher->hashPassword($user, '123456')
            );

        $entityManager->persist($user);
        $email = new UserEmail();
        $email->setEmail(sprintf('%s@mail.ru', $userName))
            ->setUser($user)
        ->setIsMain((float)rand(0,1));
        $entityManager->persist($email);
        $entityManager->flush();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
