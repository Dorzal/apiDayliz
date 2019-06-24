<?php


namespace App\DataFixtures;


use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PromotionFixtures extends Fixture
{

    public const PROMOTION_REFERENCE = 'code-test';
    public const PROMOTION_REFERENCE1 = 'code-test1';
    public const PROMOTION_REFERENCE2 = 'code-test2';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $promotion = new Promotion();
        $promotion->setCode('code-test');
        $promotion->setPercent(5);
        $promotion->setProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE));
        $manager->persist($promotion);
        $manager->flush();

        $this->addReference(self::PROMOTION_REFERENCE, $promotion);

        $promotion1 = new Promotion();
        $promotion1->setCode('code-test1');
        $promotion1->setPercent(5);
        $promotion1->setProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE1));
        $manager->persist($promotion1);
        $manager->flush();

        $this->addReference(self::PROMOTION_REFERENCE1, $promotion1);

        $promotion2 = new Promotion();
        $promotion2->setCode('code-test2');
        $promotion2->setPercent(5);
        $promotion2->setProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE2));
        $manager->persist($promotion2);
        $manager->flush();

        $this->addReference(self::PROMOTION_REFERENCE2, $promotion2);
    }
}