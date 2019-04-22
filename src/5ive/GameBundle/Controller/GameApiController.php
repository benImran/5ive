<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Game;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GameApiController extends Controller
{
    public function getGamesAction()
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine();
        $gameRepository = $em->getRepository(Game::class);
        $games = $gameRepository->findAll();

        $games = $serializer->serialize($games, 'json', SerializationContext::create()->setGroups(array('users')));
        //$games = $serializer->serialize($games, 'json');
        //$games = $serializer->toArray($games);

        echo '<pre>';
        dump($games);
        die;
//        return ;
    }
}
