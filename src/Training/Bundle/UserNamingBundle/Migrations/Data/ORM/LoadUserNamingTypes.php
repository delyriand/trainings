<?php


namespace Training\Bundle\UserNamingBundle\Migrations\Data\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class LoadUserNamingTypes extends AbstractFixture
{
    private $namingTypes = [
        ['title' => 'Official', 'format' => 'PREFIX FIRST MIDDLE LAST SUFFIX'],
        ['title' => 'Unofficial', 'format' => 'FIRST LAST'],
        ['title' => 'First name only', 'format' => 'FIRST'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach ($this->namingTypes as $namingType) {
            $namingTypeEntity = new UserNamingType();
            $namingTypeEntity->setTitle($namingType['title']);
            $namingTypeEntity->setFormat($namingType['format']);

            $manager->persist($namingTypeEntity);
        }

        $manager->flush();
    }
}