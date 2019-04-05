<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use UserBundle\Entity\User;

class UserController extends Controller
{
    public function indexAction()
    {
        $serializer = $this->get('jms_serializer');

        $users = $this->getDoctrine()->getRepository(User::class)
            ->findAll();
        $users = $serializer->toArray($users);

        return new JsonResponse($users);
    }
}
