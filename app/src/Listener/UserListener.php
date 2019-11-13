<?php
declare(strict_types=1);

namespace App\Listener;

use App\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener {

    private $password_encoder;

    public function __construct(UserPasswordEncoderInterface $password_encoder) {
        $this->password_encoder = $password_encoder;
    }

    /**
     * On encode le password
     *
     * @param User                    $user
     * @param LifecycleEventArgs      $args
     *
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @throws Exception
     */
    public function prePersist(User $user, LifecycleEventArgs $args) {

        if (!$user instanceof User) {
            return;
        }

        if(preg_match('/^\$argon([0-9]{0,2})id\$v=[0-9]{1,10}\$m=[0-9]{1,10},t=[0-9]{1,10},p=[0-9]{1,10}\$.*/', $user->getPassword()) == 0) {
            $user->setPassword($this->password_encoder->encodePassword($user, $user->getPassword()));
        }

    }

}