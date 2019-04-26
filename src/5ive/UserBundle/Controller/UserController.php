<?php

namespace UserBundle\Controller;

use Application\Sonata\MediaBundle\Entity\Media;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use UserBundle\Entity\User;



class UserController extends Controller
{
    protected $encoder;

    public function __construct(UserPasswordEncoder $encoder)
    {
        $this->encoder = $encoder;
    }


    /**
     * @Route("/api", name="api")
     *
     */
    public function indexAction()
    {
        $serializer = $this->get('jms_serializer');

        $users = $this->getDoctrine()->getRepository(User::class)
            ->findAll();
        $users = $serializer->toArray($users);

        return new JsonResponse($users);
    }

    /**
     * @Route("/api/signIn", name="signIn")
     * @Method("POST")
     * @param Request $request
     * @return Response
     */
    public function signIn(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');

        $username = $request->request->get('username');
        $password = $request->request->get('password');

        if (isset($username) || isset($password)) {

        $user = $em->getRepository(User::class)
            ->findOneBy([
                'username' => $username
            ]);

        if( $this->encoder->isPasswordValid($user,$password )){
            $user->generApiKey();

            $em->persist($user);
            $em->flush();

            $res = $this->get('app.token.generator')->getTokenAction($user, $serializer);

            return $res;
        };
        }else {
            return new Response('username ou password incorrect', 200);
        }
    }

    /**
     * @Route("/api/signUp", name="loginTEST")
     * @param Request $request
     * @return Response
     * @Method("POST")
     * @throws \Exception
     */
    public function signUp(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $encoder = $this->encoder;
        $media = $this->getDoctrine()->getRepository(Media::class)->find(1);
        //$media->set('testimg');
        $username = $request->request->get('username');
        $email = $request->request->get('email');
        $birth = str_replace('/', '.', $request->request->get('birth'));
        $regularityPlayer = $request->request->get('regularityPlayer');
        $userCity = $request->request->get('userCity');
        $picture = $request->files->get('picture');
        $password = $request->request->get('password');

        if (!isset($username) || empty($username)){ return new Response('le username est manquant');}
        if (!isset($email) || empty($email)){ return new Response('l\'email est manquant');}
        if (!isset($birth) || empty($birth)){ return new Response('la date de naissance est manquante');}
        if (!isset($regularityPlayer) || empty($regularityPlayer)){ return new Response('fréquence de jeu est manquant');}
        if (!isset($userCity) || empty($userCity)){ return new Response('la ville est manquante');}
        if (!isset($picture) || empty($picture)){ return new Response('la photo de profil est manquante');}
        if (!isset($password) || empty($password)){ return new Response('le mot de passe est manquant');}

        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setBirth(new \DateTime($birth));
        $user->setRegularityPlayer($regularityPlayer);
        $user->setUserCity($userCity);
        $user->setPicture($media);
        $user->setPassword($encoder->encodePassword($user,$password));
        $user->generApiKey();

        $em->persist($user);
        $em->flush();
        $serializer = $this->get('jms_serializer');

        $res = $this->get('app.token.generator')->getTokenAction($user, $serializer);

        return $res;
    }
}
