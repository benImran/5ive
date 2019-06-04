<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Game;
use GameBundle\Entity\Rate;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class GameApiController extends Controller
{
    /**
     * @Route("/api/listMatch", name="match_list")
     * @return Response
     */
    public function listAction()
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine();
        $gameRepository = $em->getRepository(Game::class);
        $games = $gameRepository->findAll();
        $games = $serializer->serialize($games, 'json', SerializationContext::create()->setGroups(array('games')));

        $response = new Response();
        $response->setContent($games);

        return $response;
    }


    /**
     * @Route("/api/showMatch", name="match_detail")
     * @param Request $request
     * @return Response
     */
    public function showMatchAction(Request $request)
    {
        $game = $request->get('game');

        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine();
        $gameRepository = $em->getRepository(Game::class);
        $games = $gameRepository->find($game);
        $games = $serializer->serialize($games, 'json', SerializationContext::create()->setGroups(array('game')));

        $response = new Response();
        $response->setContent($games);

        return $response;
    }




    /**
     * @Route("/api/listMatch/user", name="match_list_user")
     * @return Response
     */
    public function listByUserAction()
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine();
        $gameRepository = $em->getRepository(Game::class);
        $games = $gameRepository->findAllGameBy($this->getUser());
        $games = $serializer->serialize($games, 'json', SerializationContext::create()->setGroups(array('games')));

        $response = new Response();
        $response->setContent($games);

        return $response;

    }

    /**
     * @Route("/api/newMatch", name="match_new")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine()->getManager();

        $name = $request->request->get('name');
        $date = $request->request->get('date');
        $nbrMaxPlayers = $request->request->get('nbrMaxPlayers');
        $town = $request->request->get('town');

        if (!isset($name) || empty($name)){ return new Response('le nom de la partie est manquante');}
        if (!isset($date) || empty($date)){ return new Response('la date est manquante');}
        if (!isset($nbrMaxPlayers) || empty($nbrMaxPlayers)){ return new Response('le nombre de joueur est manquant');}
        if (!isset($town) || empty($town)){ return new Response('la ville de la partie est manquante');}


        $game = new Game();

        $game->setName($name);
        $game->setDate(new \DateTime($date));
        $game->setNbrMaxPlayers($nbrMaxPlayers);
        $game->setTown($town);
        $game->setOrganisator($this->getUser());
        $game->setIsEnd(1);
        $game->addUser($this->getUser());

        $rate = new Rate();
        $rate->setIsVote(false);
        $rate->setUsers($this->getUser());
        $rate->setGame($game);

        $em->persist($game);
        $em->flush();

        $game = $serializer->serialize($game, 'json', SerializationContext::create()->setGroups(array('game')));

        return new Response($game);
    }

    /**
     * @Route("/api/joinMatch", name="match_join")
     * @param Request $request
     * @return Response
     */
    public function joinPlayersActions(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');

        $game = $em->getRepository(Game::class)
            ->find($request->get('game'));

        if (count($game->getUsers()) == $game->getNbrMaxPlayers()) {
            return new Response('Le nombre maximum de joueur est atteint',200);
        }
        else {
            $game->addUser($this->getUser());
            $rate = new Rate();

            $rate->setIsVote(false);

            $rate->setUsers($this->getUser());
            $rate->setGame($game);
            $em->persist($rate);
        }

        $em->persist($game);
        $em->flush();

        $game = $em->getRepository(Game::class)
            ->find($request->get('game'));

        $game = $serializer->serialize($game, 'json', SerializationContext::create()->setGroups(array('game')));

        return new Response($game);

    }
}
