<?php


namespace App\DataFixtures;


use App\Entity\Premium;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PremiumFixtures extends Fixture
{
    public const PREMIUM_REFERENCE = 'premium-test';
    public const PREMIUM_REFERENCE1 = 'premium-test1';
    public const PREMIUM_REFERENCE2 = 'premium-test2';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $premium = new Premium();
        $premium->setName('premium-test');
        $premium->setTime(2);
        $premium->setPrice("2.99");
        $premium->setLogo('logo.jpeg');
        $premium->setDescription('description');
        $manager->persist($premium);
        $manager->flush();

        $this->addReference(self::PREMIUM_REFERENCE, $premium);


        $premium1 = new Premium();
        $premium1->setName('premium-test1');
        $premium1->setTime(3);
        $premium1->setPrice("2.99");
        $premium1->setLogo('logo.jpeg');
        $premium1->setDescription('description');
        $manager->persist($premium1);
        $manager->flush();

        $this->addReference(self::PREMIUM_REFERENCE1, $premium1);



        $premium2 = new Premium();
        $premium2->setName('premium-test2');
        $premium2->setTime(4);
        $premium2->setPrice("2.99");
        $premium2->setLogo('logo.jpeg');
        $premium2->setDescription('description');
        $manager->persist($premium2);
        $manager->flush();

        $this->addReference(self::PREMIUM_REFERENCE2, $premium2);
    }
}