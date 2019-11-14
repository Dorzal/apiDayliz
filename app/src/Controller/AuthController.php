<?php


namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

class AuthController {
    private $em;
    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function register(Request $request, UserPasswordEncoderInterface $password_encoder) {
        $datas = \json_decode($request->getContent(), true);

        if(preg_match('/^\$argon([0-9]{0,2})id\$v=[0-9]{1,10}\$m=[0-9]{1,10},t=[0-9]{1,10},p=[0-9]{1,10}\$.*/', $datas['password']) == 1) {
            return new Response('password incorrect');
        }
        // Création du user
        try {
            $user = new User();
            $user->setEmail($datas['email']);
            $user->setPassword($password_encoder->encodePassword($user, $datas['password']));
            $user->setRoles(['ROLE_USER']);
            $user->setFirstName($datas['firstName']);
            $user->setLastName($datas['lastName']);
            $user->setAvatar('string.png');
            $user->setBirthday(\DateTime::createFromFormat('Y-m-d', $datas['birthday']));
            $this->em->persist($user);
            $this->em->flush();

            $response = new Response(json_encode(["email" => $user->getEmail()]));
            $response->headers->set('Content-Type', 'application/json');

            return $response;
        } catch (\Exception $e) {
            return new Response($e);
        }
    }

}
