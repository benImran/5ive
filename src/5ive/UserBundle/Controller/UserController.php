<?php

namespace UserBundle\Controller;

use Application\Sonata\MediaBundle\Entity\Media;
use GameBundle\Entity\Game;
use GameBundle\Entity\Rate;
use JMS\Serializer\SerializationContext;
use LevelBundle\Entity\Level;
use LevelBundle\Entity\Rank;
use RegularityPlayerBundle\Entity\RegularityPlayer;
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
     * @Route("/", name="landing_page")
     */
    public function landingPageAction()
    {
        return $this->render(':default:index.html.twig');

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
        $bio = $request->request->get('bio');
        $birth = str_replace('/', '.', $request->request->get('birth'));
        $regularityPlayer = $request->request->get('regularityPlayer');
        $userCity = $request->request->get('userCity');
        $picture = $request->files->get('picture');
        $password = $request->request->get('password');

        if (!isset($username) || empty($username)){ return new Response('le username est manquant');}
        if (!isset($email) || empty($email)){ return new Response('l\'email est manquant');}
        if (!isset($birth) || empty($birth)){ return new Response('la date de naissance est manquante');}
        if (!isset($bio) || empty($bio)){ return new Response('la bio est manquante');}
        if (!isset($regularityPlayer) || empty($regularityPlayer)){ return new Response('la fréquence de jeu est manquante');}
        if (!isset($userCity) || empty($userCity)){ return new Response('la ville est manquante');}
        if (!isset($password) || empty($password)){ return new Response('le mot de passe est manquant');}

        $user = new User();

        $user->setUsername($username);
        $user->setEmail($email);
        $user->setBirth(new \DateTime($birth));
        $user->setBio($bio);
        $user->setRegularityPlayers($regularityPlayer);
        $user->setUserCity($userCity);
        if (!isset($picture) || empty($picture)){
            $user->setPicture($media);
        }
        $user->setPassword($encoder->encodePassword($user,$password));
        $user->setEnabled(true);
        $user->generApiKey();

        $em->persist($user);

        $level = new Level();
        $rank = $this->getDoctrine()
            ->getRepository(Rank::class)
            ->findRankBy($level->getCountMatch());
        $level->setRank($rank);
        $level->setUsers($user);

        $em->persist($level);
        $em->flush();
        $serializer = $this->get('jms_serializer');

        $res = $this->get('app.token.generator')->getTokenAction($user, $serializer);

        return $res;
    }

    /**
     * @Route("/api/editProfil", name="edit_profil")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function editProfilAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

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

        /*  dump($username);
          dump(isset($username));
          dump(!empty($username));
          dump($email);
          dump(isset($email));
          dump(!empty($email));
          die;*/
        if (isset($username) || !empty($username)){
            $user->setUsername($username);
        }
        if (isset($email) || !empty($email)){
            $user->setEmail($email);
        }
        if (isset($birth) || !empty($birth)){
            $user->setBirth(new \DateTime($birth));
        }
        if (isset($regularityPlayer) || !empty($regularityPlayer)){
            $regularityPlayer= $this->getDoctrine()->getRepository(RegularityPlayer::class)->find($regularityPlayer);
            $user->setRegularityPlayers($regularityPlayer);
        }
        if (isset($userCity) || !empty($userCity)){
            $user->setUserCity($userCity);
        }
        if (isset($password) || !empty($password)){
            $user->setPassword($encoder->encodePassword($user,$password));
        }
        if (!isset($picture) || empty($picture)){
            $user->setPicture($picture);
        }

        $em->persist($user);
        $em->flush();

        $serializer = $this->get('jms_serializer');

//        $res = $this->get('app.token.generator')->getTokenAction($user, $serializer);

        $user = $serializer->serialize($this->getUser(), 'json', SerializationContext::create()->setGroups(array('profil')));

        $response = new Response();
        $response->setContent($user);

        return $response;

    }

    /**
     * @Route("/api/profil", name="profile")
     * @return Response
     */
    public function profilAction()
    {
        $serializer = $this->get('jms_serializer');

        $user = $serializer->serialize($this->getUser(), 'json', SerializationContext::create()->setGroups(array('profil')));

        $response = new Response();
        $response->setContent($user);

        return $response;
    }



    /**
     * @Route("/api/profilLevel", name="profile level")
     * @return Response
     */
    public function profilLevelAction()
    {
        $serializer = $this->get('jms_serializer');

        $user = $serializer->serialize($this->getUser(), 'json', SerializationContext::create()->setGroups(array('profilLevel')));

        $response = new Response();
        $response->setContent($user);

        return $response;
    }


    /**
     * @Route("/api/endMatch", name="end_match")
     * @param Request $request
     * @return Response
     */
    public function endMatchAction(Request $request)
    {
        $match = $request->request->get('match');

        $em = $this->getDoctrine()->getManager();

        $match = $em->getRepository(Game::class)
            ->find($match);

        $users = $match->getUsers();

        $match->setIsEnd(true);

        $em->persist($match);
        $em->flush();

        foreach ($users as $user) {
            $this->upMatch($user);
        }

        return new Response('Good');

    }

    /**
     * @param $user
     * @return void
     */
    public function upMatch($user)
    {

        $em = $this->getDoctrine()->getManager();

        $levelUser = $user->getLevel();

        $newMatch = $levelUser->getCountMatch() + 1;

        $levelUser->setCountMatch($newMatch);

        $em->persist($levelUser);
        $em->flush();

        $this->rankUpAction($user->getId());

    }

    public function rankUpAction($userId)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->find($userId);
        $levelUser = $user->getLevel();

        $match = $levelUser->getCountMatch();
        $rank = $this->getDoctrine()->getRepository(Rank::class)->findRankBy($match);
        $levelUser->setRank($rank);
        $em->persist($levelUser);
        $em->flush();
    }


    /**
     * @Route("/api/ratePlayers", name="api_rate_players")
     * @param Request $request
     * @return Response
     */
    public function ratePlayersAction(Request $request)
    {
        $usersData = $request->get('users');

        $gameData = $request->get('game');

        $em = $this->getDoctrine()->getManager();

        $game = $this->getDoctrine()->getRepository(Game::class)->find($gameData);

        $rate = new Rate();
        $rate->setIsVote(true);
        $rate->setUsers($this->getUser());
        $rate->setGame($game);

        foreach ($usersData as $userData) {

            $user = $this->getDoctrine()->getRepository(User::class)->find($userData['id']);

            $level = $user->getLevel();

            $userLevel = $userData['level'];
            $level->setAttaque($userLevel['attaque']);
            $level->setDefense($userLevel['defense']);
            $level->setGardien($userLevel['gardien']);
            $level->setCountRedCard($userLevel['redCard']);
            $level->setCountYellowCard($userLevel['yellowCard']);

            $em->persist($level);
            $em->persist($rate);

        }

        $em->flush();

        return new Response('ok');
    }

}
