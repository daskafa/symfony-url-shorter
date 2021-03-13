<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/signupview", name="app_signup_view")
     */
    public function signupView(): Response{
        return $this->render('security/signup.html.twig');
    }




    /**
     * @Route("/signup", name="app_signup")
     */
    public function signup(UserPasswordEncoderInterface $encoder, Request $request): Response{

        $user = new User();
//        dd($request->get('email'));

        $email = $request->get('email');
        $encodedPassword = $encoder->encodePassword($user, $request->get('password'));

        $user->setEmail($email)
            ->setPassword($encodedPassword)
            ->setIsActive('')
            ->setRoles(['ROLE_USER']);

        $em = $this->getDoctrine()->getManager();

        $em->persist($user);
        $em->flush();

        return new Response('User created !');

    }
}
