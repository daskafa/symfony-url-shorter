<?php
namespace App\Controller;

use App\Entity\Url;
use App\Entity\User;
use App\Repository\HomepageInterfaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(HomepageInterfaceRepository $homepageInterfaceRepository): Response
    {
        # TODO : GET CMS data from RDBMS DB


        $posts = $homepageInterfaceRepository->findAll();


        return $this->render('home/test.html.twig', [
            'posts' => $posts
        ]);
    }


}
