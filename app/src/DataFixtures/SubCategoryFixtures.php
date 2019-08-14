<?php


namespace App\DataFixtures;


use App\Entity\SubCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SubCategoryFixtures extends Fixture
{

    public const PRODUCT_REFERENCE  = 'sous-test';
    public const PRODUCT_REFERENCE1  = 'sous-test1';
    public const PRODUCT_REFERENCE2  = 'sous-test2';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $subCategory = new SubCategory();
        $subCategory->setName('sous-test');
        $subCategory->setLogo('sous-logo.jpeg');
        $subCategory->setCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE));
        $subCategory->addProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE));

        $manager->persist($subCategory);
        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE, $subCategory);

        $subCategory1 = new SubCategory();
        $subCategory1->setName('sous-test1');
        $subCategory1->setLogo('sous-logo.jpeg');
        $subCategory1->setCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE1));
        $subCategory1->addProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE1));

        $manager->persist($subCategory1);
        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE1, $subCategory1);


        $subCategory2 = new SubCategory();
        $subCategory2->setName('sous-test2');
        $subCategory2->setLogo('sous-logo.jpeg');
        $subCategory2->setCategory($this->getReference(CategoryFixtures::CATEGORY_REFERENCE2));
        $subCategory2->addProduct($this->getReference(ProductFixtures::PRODUCT_REFERENCE2));

        $manager->persist($subCategory2);
        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE2, $subCategory2);
    }
}