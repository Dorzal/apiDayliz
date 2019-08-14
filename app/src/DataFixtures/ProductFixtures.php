<?php


namespace App\DataFixtures;


use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{

    public const PRODUCT_REFERENCE ='product-test';
    public const PRODUCT_REFERENCE1 ='product-test1';
    public const PRODUCT_REFERENCE2 ='product-test2';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $product = new Product();
        $product->setName('product-test');
        $product->setDescription('description-test');
        $product->setPicture('picture-test');
        $product->setPrice('35.99');
        $product->setUrl('www.test.fr');
        $product->addCommentary($this->getReference(CommentaryFixtures::COMMENTARY_REFERENCE));
        $product->setMark($this->getReference(MarkFixtures::COMPANY_REFERENCE));


        $manager->persist($product);
        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE, $product);


        $product1 = new Product();
        $product1->setName('product-test1');
        $product1->setDescription('description-test');
        $product1->setPicture('picture-test');
        $product1->setPrice('35.99');
        $product1->setUrl('www.test.fr');
        $product1->addCommentary($this->getReference(CommentaryFixtures::COMMENTARY_REFERENCE1));
        $product1->setMark($this->getReference(MarkFixtures::COMPANY_REFERENCE1));


        $manager->persist($product1);
        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE1, $product1);

        $product2 = new Product();
        $product2->setName('product-test2');
        $product2->setDescription('description-test');
        $product2->setPicture('picture-test');
        $product2->setPrice('35.99');
        $product2->setUrl('www.test.fr');('www.test.fr');
        $product2->addCommentary($this->getReference(CommentaryFixtures::COMMENTARY_REFERENCE2));
        $product2->setMark($this->getReference(MarkFixtures::COMPANY_REFERENCE2));


        $manager->persist($product2);
        $manager->flush();

        $this->addReference(self::PRODUCT_REFERENCE2, $product2);
    }
}