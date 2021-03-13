<?php

namespace App\Controller\Admin;

use App\Repository\UrlRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/admin', name: 'admin_default')]
    public function index(UrlRepository $urlRepository, UserRepository $userRepository, Request $request): Response
    {
        $urls = $urlRepository->findAll();
        $users = $userRepository->findAll();
        return $this->render('admin/default/index.html.twig', [
            'urls' => $urls,
            'users' => $users
        ]);
    }
}
