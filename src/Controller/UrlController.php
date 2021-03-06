<?php

namespace App\Controller;

use App\Entity\Url;
use App\Entity\UrlStats;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Detection\MobileDetect;
use Symfony\Component\Validator\Constraints as Assert;

class UrlController extends AbstractController
{

    #[Route('/url/create', name: 'url_create')]
    public function create(Request $request, ValidatorInterface $validator, AuthenticationUtils $authenticationUtils): Response
    {

        $url = $request->get('url');
        $shortUrl = null;
        $name = 'volkan';
        $email = 'testemail_adresi';
        # url validation
        $constraints = new Assert\Collection([
            #'name' => [ new Assert\Length(['min'=>10]), new Assert\Length(['max'=>12]) ],
            #'email' => [ new Assert\Email()],
            'url' => [ new Assert\Url() ]
        ]);
        $violations = $validator->validate([
            #'name'=>$name,
            #'email'=>$email,
            'url'=>$url
        ], $constraints);
        $accessor = PropertyAccess::createPropertyAccessor();
        $errorMessages = [];
        foreach($violations as $v){
            $accessor->setValue($errorMessages, $v->getPropertyPath(), $v->getMessage() );
        }
        if (count($errorMessages)===0){
            # generate 5 digit hash
            $alpha_numeric = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $url_hash = substr( str_shuffle($alpha_numeric),0,5);
            $em = $this->getDoctrine()->getManager();
//            $user = new User();
            $rep = $em->getRepository(User::class);
            $getUser = $this->getUser();
            $user = $rep->find($getUser->getId());
            $url_item = new Url();
            $url_item->setUrl($url)
                ->setUrlHash( $url_hash )
                ->setCreatedAt( (new \DateTime()) )
                ->setClickCount(0)
                ->setIsPublic(true)
                ->setExpiredAt(( new \DateTime() ))
                ->setIsActive(true)
                ->setUser($user);
            if( is_null( $this->getUser() ) ) {
                $url_item->setUserId(0);
            } else {
//                $user_id=$this->getUser()->getId();
                $url_item->setUserId($getUser->getId());
            }
//            dd($url_item);
            $em->persist($url_item);
            $em->flush();
            $shortUrl = 'http://pa.th/'.$url_hash;
        }
        return new JsonResponse([
            'success'=>count($errorMessages)===0??false,
            'response'=>$shortUrl,
            'error'=>count($errorMessages)>0??false,
            'errorMessage'=>count($errorMessages)>0?$errorMessages:null
        ],200);
    }
    #[Route('/{urlHash}', name: 'redirector')]
    public function redirector($urlHash, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $urlRepository = $em->getRepository(Url::class);
//        dd($urlRepository->findOneBy([
//            'is_active'=>true,
//            'urlHash'=>$urlHash
//        ]));
        $url_item = $urlRepository->findOneBy([
            'is_active'=>true,
            'urlHash'=>$urlHash
        ]);
        if ($url_item){
            $url = $url_item->getUrl();
            $urlId = $url_item->getId();
            $this->saveStats($urlId, $request);
            return $this->redirect($url);
        }
        return $this->redirectToRoute('home');
    }
    public function saveStats($urlId, Request $request){
        $detect = new MobileDetect();
        $ip = '15,393,728';
        $geo = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='. $ip));
        $city = $geo['geoplugin_city'];
        $country = $geo['geoplugin_countryName'];
        $userAgent = $request->headers->get('User-Agent');
        $clientIp = $request->getClientIp();
        $em = $this->getDoctrine()->getManager();
        $d = '';
        if ($detect->isMobile()){
            $d = 'Mobil';
        }else if($detect->isTablet()){
            $d = 'Tablet';
        }else{
            $d = 'B??y??k ??htimal PC :)';
        }
        $url_stats = new UrlStats();
        $url_stats->setUrlId($urlId)
            ->setBrowser($userAgent)
            ->setIpAddress($clientIp)
            ->setDevice($d)
            ->setResolution('-')
            ->setLocale(\Locale::getDefault())
            ->setCity($city)
            ->setCountry($country)
            ->setCreatedAt( ( new \DateTime() ));
        $em->persist($url_stats);
        $em->flush();
    }
}
