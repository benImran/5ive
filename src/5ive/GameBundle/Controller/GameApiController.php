<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Game;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @Route("/api/newMatch", name="match_new")
     * @param Request $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $name = $request->request->get('name');
        $date = $request->request->get('date');
        $nbrMaxPlayers = $request->request->get('nbrMaxPlayers');
        $town = $request->request->get('town');


        if (isset($name) || empty($name)){ return new Response('le nom de la partie est manquante');}
        if (isset($date) || empty($date)){ return new Response('la date est manquante');}
        if (isset($nbrMaxPlayers) || empty($nbrMaxPlayers)){ return new Response('le nombre de joueur est manquant');}
        if (isset($town) || empty($town)){ return new Response('la ville de la partie est manquante');}


        $game = new Game();

        $game->setName($name);
        $game->setDate(new \DateTime($date));
        $game->setChat('ouais');
        $game->setNbrMaxPlayers($nbrMaxPlayers);
        $game->setTown($town);
        $game->setOrganisator($this->getUser());
        $game->addUser($this->getUser());

        $em->persist($game);
        $em->flush();

        return new Response('ok', 200);
    }

    /**
     * @Route("/api/joinMatch", name="match_join")
     * @param Request $request
     * @return Response
     */
    public function joinPlayersActions(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $game = $em->getRepository(Game::class)
            ->find($request->get('game'));

        if (count($game->getUsers()) == $game->getNbrMaxPlayers()) {
            return new Response('Le nombre maximum de joueur est atteint',200);
        }
        else {
            $game->addUser($this->getUser());
        }

        $em->persist($game);
        $em->flush();

        return new Response('ok', 200);

    }
}
