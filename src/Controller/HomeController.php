<?php
namespace App\Controller;

use App\Entity\ContactMessages;
use App\Entity\Url;
use App\Entity\User;
use App\Repository\ContactMessagesRepository;
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
        return $this->render('home/index.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/iletisim', name: 'contact')]
    public function contactView(HomepageInterfaceRepository $homepageInterfaceRepository){
        $posts = $homepageInterfaceRepository->findAll();
        return $this->render('home/contact.html.twig', [
           'posts' => $posts
        ]);
    }

    #[Route('/iletisimPost', name: 'contactPost')]
    public function contactPost(ContactMessagesRepository $contactMessagesRepository, Request $request){
        $em = $this->getDoctrine()->getManager();

        $contactPosts = new ContactMessages();

        $contactPosts->setName($request->get('name'))
            ->setEmail($request->get('email'))
            ->setMessage($request->get('message'));

        $em->persist($contactPosts);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    #[Route('/delete-post/{id}', name: 'deletePost')]
    public function deleteContactPost(int $id, ContactMessagesRepository $contactMessagesRepository, Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $contactPost = $entityManager->getRepository(ContactMessages::class)->find($id);

        $entityManager->remove($contactPost);
        $entityManager->flush();
        return $this->redirectToRoute('contact_messages');

    }


}
