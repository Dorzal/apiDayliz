<?php


namespace App\Controller;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController
{

    private $_em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_em = $entityManager;
    }


    public function search(Request $request) {
        $datas = \json_decode($request->getContent(), true);


        $user = $this->_em->getRepository(User::class)->findOneBy(['email' => $datas['email']]);


        $response = new Response(json_encode(["id" => $user->getid()]));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}