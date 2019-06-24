<?php


namespace App\DataFixtures;


use App\Entity\Commentary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentaryFixtures extends Fixture
{

    public const COMMENTARY_REFERENCE = 'test-content';
    public const COMMENTARY_REFERENCE1 = 'test-content1';
    public const COMMENTARY_REFERENCE2 = 'test-content2';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $comment = new Commentary();
        $comment->setContent('test-content');
        $comment->setCreatedAt(new \DateTime());
        $manager->persist($comment);
        $manager->flush();

        $this->addReference(self::COMMENTARY_REFERENCE, $comment);

        $comment1 = new Commentary();
        $comment1->setContent('test-content1');
        $comment1->setCreatedAt(new \DateTime());
        $manager->persist($comment1);
        $manager->flush();

        $this->addReference(self::COMMENTARY_REFERENCE1, $comment1);

        $comment2 = new Commentary();
        $comment2->setContent('test-content2');
        $comment2->setCreatedAt(new \DateTime());
        $manager->persist($comment2);
        $manager->flush();

        $this->addReference(self::COMMENTARY_REFERENCE2, $comment2);
    }
}