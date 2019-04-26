<?php

namespace Model;

use JMS\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class TokenService
{
    public function getTokenAction(User $user,Serializer $serializer)
    {

        $res = [
            'userKey' => $user->getApiKey(),
            'expires' => new \DateTime('now +1 day')
        ];

        $data = $serializer->serialize($res,'json');

        return new Response($data, 200);
    }
}