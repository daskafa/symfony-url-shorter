<?php

namespace App\Controller\Admin;

use App\Entity\HomepageInterface;
use App\Repository\ContactMessagesRepository;
use App\Repository\HomepageInterfaceRepository;
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

    #[Route('/admin/kayitli-kullanicilar', name: 'kayitli_kullanicilar')]
    public function registeredUsers(Request $request, UserRepository $userRepository): Response{
        $users = $userRepository->findAll();
        return $this->render('admin/default/registered-users.html.twig',[
            'users' => $users
        ]);
    }

    #[Route('/admin/banner-alani-duzenleme', name: 'banner_alani_duzenleme')]
    public function bannerField(): Response{
        return $this->render('admin/default/banner-field.html.twig',[
        ]);
    }

    #[Route('/admin/banner-alani-duzenleme-edit', name: 'banner_alani_duzenleme_edit')]
    public function bannerFieldEdit(Request $request, HomepageInterfaceRepository $homepageInterfaceRepository): Response{
        $all = $homepageInterfaceRepository->findAll();
        dd($all[0]);
        $title = $all[0]->getTitle();
        $description = $all[0]->getDescription();
        $buttonText = $all[0]->getButtonText();

        $title = $request->get('title');
        $description = $request->get('description'); // CONTACT ENTİTY OLUŞTUR, EN SON SİLMİŞTİN
        $buttonText = $request->get('button');

        $homepageInterface = new HomepageInterface();
        $homepageInterface->setTitle($title)
            ->setDescription($description)
            ->setButtonText($buttonText);

        $em = $this->getDoctrine()->getManager();
        $em->persist($homepageInterface);
        $em->flush();
        return $this->redirectToRoute('admin_default');
    }
    #[Route('/admin/gelen-mesajlar', name: 'contact_messages')]
    public function contactMessages(ContactMessagesRepository $contactMessagesRepository){

        $messages = $contactMessagesRepository->findAll();


        return $this->render('admin/default/contact-messages.html.twig',[
            'messages' => $messages
        ]);
    }

}
