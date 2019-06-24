<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;
    public const USER = 'test@test.fr';
    public const USER1 = 'test1@test.fr';
    public const USER2 = 'test2@test.fr';

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $roles[] = 'ROLE_USER';
        $user = new User();
        $user->setEmail('test@test.fr');
        $user->setFirstName('fn-test');
        $user->setLastName('ln-test');
        $user->setRoles($roles);
        $user->setAvatar("avatar.jpeg");
        $user->setCreatedAt(new \DateTime());
        $user->setBirthday(new \DateTime());
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'password-test'));
        $user->addInterest($this->getReference(SubCategoryFixtures::PRODUCT_REFERENCE));
        $user->setPremium($this->getReference(PremiumFixtures::PREMIUM_REFERENCE));
        $user->addCommentary($this->getReference(CommentaryFixtures::COMMENTARY_REFERENCE));
        $user->addLikeProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE));

        $manager->persist($user);
        $manager->flush();

        $this->addReference(self::USER, $user);



        $user1 = new User();
        $user1->setEmail('test1@test.fr');
        $user1->setFirstName('fn-test');
        $user1->setLastName('ln-test');
        $user1->setRoles($roles);
        $user1->setAvatar("avatar.jpeg");
        $user1->setCreatedAt(new \DateTime());
        $user1->setBirthday(new \DateTime());
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'password-test'));
        $user1->addInterest($this->getReference(SubCategoryFixtures::PRODUCT_REFERENCE1));
        $user1->setPremium($this->getReference(PremiumFixtures::PREMIUM_REFERENCE1));
        $user1->addCommentary($this->getReference(CommentaryFixtures::COMMENTARY_REFERENCE1));
        $user1->addLikeProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE1));

        $manager->persist($user1);
        $manager->flush();

        $this->addReference(self::USER1, $user1);




        $user2 = new User();
        $user2->setEmail('test2@test.fr');
        $user2->setFirstName('fn-test');
        $user2->setLastName('ln-test');
        $user2->setRoles($roles);
        $user2->setAvatar("avatar.jpeg");
        $user2->setCreatedAt(new \DateTime());
        $user2->setBirthday(new \DateTime());
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'password-test'));
        $user2->addInterest($this->getReference(SubCategoryFixtures::PRODUCT_REFERENCE2));
        $user2->setPremium($this->getReference(PremiumFixtures::PREMIUM_REFERENCE2));
        $user2->addCommentary($this->getReference(CommentaryFixtures::COMMENTARY_REFERENCE2));
        $user2->addLikeProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE2));

        $manager->persist($user2);
        $manager->flush();

        $this->addReference(self::USER2, $user2);
    }
}