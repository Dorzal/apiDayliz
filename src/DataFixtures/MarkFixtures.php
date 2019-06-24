<?php


namespace App\DataFixtures;


use App\Entity\Mark;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MarkFixtures extends Fixture
{

    public const COMPANY_REFERENCE = 'company-test';
    public const COMPANY_REFERENCE1 = 'company-test1';
    public const COMPANY_REFERENCE2 = 'company-test2';

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $company = new Mark();
        $company->setName('company-test');
        $company->setLogo('logo-company.jpeg');
        $company->setUrl('url.com');
        $manager->persist($company);
        $manager->flush();

        $this->addReference(self::COMPANY_REFERENCE, $company);

        $company1 = new Mark();
        $company1->setName('company-test1');
        $company1->setLogo('logo-company.jpeg');
        $company1->setUrl('url.com');
        $manager->persist($company1);
        $manager->flush();

        $this->addReference(self::COMPANY_REFERENCE1, $company1);

        $company2 = new Mark();
        $company2->setName('company-test2');
        $company2->setLogo('logo-company.jpeg');
        $company2->setUrl('url.com');
        $manager->persist($company2);
        $manager->flush();

        $this->addReference(self::COMPANY_REFERENCE2, $company2);
    }
}