<?php

namespace GameBundle\Controller;

use GameBundle\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class GameApiController extends Controller
{
    public function getGamesAction()
    {
        $serializer = $this->get('jms_serializer');

        $em = $this->getDoctrine();
        $gameRepository = $em->getRepository(Game::class);
        $games = $gameRepository->findAll();

        $games = $serializer->toArray($games);

        echo '<pre>';
        print_r($games);
        die;
//        return ;
    }
}
