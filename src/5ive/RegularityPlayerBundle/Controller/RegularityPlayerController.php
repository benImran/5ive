<?php

namespace RegularityPlayerBundle\Controller;

use JMS\Serializer\SerializationContext;
use RegularityPlayerBundle\Entity\RegularityPlayer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class RegularityPlayerController extends Controller
{
    /**
     * @Route("/api/regularityPlayerList", name="api_regularity_players_list")
     */
    public function regularityPlayerListAction()
    {
        $list = $this->getDoctrine()->getRepository(RegularityPlayer::class)
            ->findAll();
        $serializer = $this->get('jms_serializer');

        $user = $serializer->serialize($list, 'json', SerializationContext::create()->setGroups(array('list')));

        $response = new Response();
        $response->setContent($user);

        return $response;
    }
}
