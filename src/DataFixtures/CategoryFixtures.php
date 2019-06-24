<?php


namespace App\DataFixtures;


use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{

    public const CATEGORY_REFERENCE = 'test';
    public const CATEGORY_REFERENCE1 = 'test1';
    public const CATEGORY_REFERENCE2 = 'test2';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setLogo('logo.jpeg');
        $category->setName('test');
        $manager->persist($category);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE, $category);

        $category1 = new Category();
        $category1->setLogo('logo.jpeg');
        $category1->setName('test1');
        $manager->persist($category1);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE1, $category1);

        $category2 = new Category();
        $category2->setLogo('logo.jpeg');
        $category2->setName('test2');
        $manager->persist($category2);
        $manager->flush();

        $this->addReference(self::CATEGORY_REFERENCE2, $category2);
    }
}