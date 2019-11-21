<?php


namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class BouquetController
{
    private $_em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_em = $entityManager;
    }


    public function bouquet($id) {

        $today = date("Y-m-d");



        $sql = "select p.id , p.name, p.price, p.description, p.picture, p.url, p.show_at
                from \"user\" as u 
                inner join user_sub_category as us
                on u.id = us.user_id
                inner join sub_category as s
                on us.sub_category_id = s.id
                inner join product as p
                on s.id = p.sub_category_id
                where u.id = $id
                and p.show_at = '$today'";


        $conn = $this->_em->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $response = new Response(json_encode($stmt->fetchAll()));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}