<?php

namespace AdminBundle\Controller;

use LevelBundle\Entity\Rank;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig');
    }
    /**
     * @Route("/test")
     */
    public function indexTestAction()
    {
        $em = $this->getDoctrine()->getRepository(Rank::class)->findRankBy(25);

        return $this->render('AdminBundle:Default:index.html.twig');
    }
}
