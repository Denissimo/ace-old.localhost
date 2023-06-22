<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ContentController extends AbstractController
{
    #[Route('/content', name: 'app_content')]
    public function index(Security $security): Response
    {
        /** @var User|null $user */
        $user = $security->getUser();
        return $this->render('content/index.html.twig', [
            'username' => $user instanceof User ? $user->getUserIdentifier() : '',
            'controller_name' => 'ContentController',
        ]);
    }
}
