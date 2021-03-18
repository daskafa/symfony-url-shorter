<?php

namespace App\Controller\Admin;

use App\Entity\ContactMessages;
use App\Entity\Features;
use App\Entity\HomepageInterface;
use App\Entity\PageConfigs;
use App\Entity\User;
use App\Repository\ContactMessagesRepository;
use App\Repository\FeaturesRepository;
use App\Repository\HomepageInterfaceRepository;
use App\Repository\PageConfigsRepository;
use App\Repository\UrlRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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

//    #[Route('/admin/banner-alani-duzenleme', name: 'banner_alani_duzenleme')]
//    public function bannerField(): Response{
//        return $this->render('admin/default/banner-field.html.twig',[
//        ]);
//    }

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
    public function contactMessages(ContactMessagesRepository $contactMessagesRepository, UserRepository $userRepository){
        $users = $userRepository->findAll();

        $messages = $contactMessagesRepository->findAll();


        return $this->render('admin/default/contact-messages.html.twig',[
            'messages' => $messages,
            'users' => $users
        ]);
    }

    #[Route('/admin/gelen-mesajlar/{id}', name: 'contact_is_read')]
    public function contactMessagesIsRead(int $id, ContactMessagesRepository $contactMessagesRepository){
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository(ContactMessages::class)->find($id);

        if ($product->getIsRead() == false){
            $product->setIsRead(1);
        }else{
            $product->setIsRead(0);
        }
        $em->persist($product);
        $em->flush();
        return $this->redirectToRoute('contact_messages');
    }

    #[Route('/admin/sayfa-ayarlari', name: 'page_config')]
    public function pageConfigsView(UserRepository $userRepository){
        $users = $userRepository->findAll();
        return $this->render('admin/default/page-config.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/admin/sayfa-title')]
    public function pageConfigTitle(Request $request, PageConfigsRepository $pageConfigsRepository){
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(PageConfigs::class)->find(1);
        $item->setContent($request->get('content'));
        $em->persist($item);
        $em->flush();
        return $this->redirectToRoute('page_config');
    }

    #[Route('/admin/sayfa-description')]
    public function pageConfigDescription(Request $request, PageConfigsRepository $pageConfigsRepository){
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(PageConfigs::class)->find(2);
        $item->setContent($request->get('content'));
        $em->persist($item);
        $em->flush();
        return $this->redirectToRoute('page_config');
    }

    #[Route('/admin/sayfa-buton')]
    public function pageConfigButton(Request $request, PageConfigsRepository $pageConfigsRepository){
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(PageConfigs::class)->find(3);
        $item->setContent($request->get('content'));
        $em->persist($item);
        $em->flush();
        return $this->redirectToRoute('page_config');
    }

    #[Route('/admin/sayfa-privacy')]
    public function pageConfigPrivacy(Request $request, PageConfigsRepository $pageConfigsRepository){
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(PageConfigs::class)->find(4);
        $item->setContent($request->get('content'));
        $em->persist($item);
        $em->flush();
        return $this->redirectToRoute('page_config');
    }

    #[Route('/admin/sayfa-privacy-2')]
    public function pageConfigPrivacy2(Request $request, PageConfigsRepository $pageConfigsRepository){
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(PageConfigs::class)->find(5);
        $item->setContent($request->get('content'));
        $em->persist($item);
        $em->flush();
        return $this->redirectToRoute('page_config');
    }

    #[Route('/admin/sayfa-privacy-3')]
    public function pageConfigPrivacy3(Request $request, PageConfigsRepository $pageConfigsRepository){
        $em = $this->getDoctrine()->getManager();
        $item = $em->getRepository(PageConfigs::class)->find(6);
        $item->setContent($request->get('content'));
        $em->persist($item);
        $em->flush();
        return $this->redirectToRoute('page_config');
    }

    #[Route('/admin/ozellikler', name: 'features')]
    public function pageFeatures(UserRepository $userRepository, FeaturesRepository $featuresRepository){
        $users = $userRepository->findAll();
        $feature = $featuresRepository->findAll();

        return $this->render('admin/default/features.html.twig', [
            'users' => $users,
            'feature' => $feature
        ]);
    }

    #[Route('/admin/ozellikler/{id}', name: 'xxx')]
    public function pageFeatureUpdate(int $id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $feature = $em->getRepository(Features::class)->find($id);

        $feature->setTitle($request->get('title'))
            ->setDescription($request->get('description'));

        $em->persist($feature);
        $em->flush();
        return $this->redirectToRoute('features');
    }

    #[Route('/admin/profil-guncelle', name: 'profil_update')]
    public function pageProfilView(UserRepository $userRepository){
        $users = $userRepository->findAll();
        return $this->render('admin/default/profil-update.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/admin/profil-guncelle/{id}', name: 'xxx')]
    public  function pageProfilUpdate(int $id, Request $request, UserPasswordEncoderInterface $encoder, AuthenticationUtils $authenticationUtils, UserRepository $userRepository){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
//        $user = $userRepository->findAll();


        $email = $request->get('email');
        $encodedPassword = $encoder->encodePassword($user, $request->get('password'));
        $user->setEmail($email)
            ->setPassword($encodedPassword);

        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('profil_update');
    }













}
