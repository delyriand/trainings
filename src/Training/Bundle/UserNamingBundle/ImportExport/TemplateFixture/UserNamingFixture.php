<?php

namespace Training\Bundle\UserNamingBundle\ImportExport\TemplateFixture;

use Oro\Bundle\ImportExportBundle\TemplateFixture\AbstractTemplateRepository;
use Oro\Bundle\ImportExportBundle\TemplateFixture\TemplateFixtureInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingFixture extends AbstractTemplateRepository implements TemplateFixtureInterface
{
    public function getEntityClass()
    {
        return UserNamingType::class;
    }

    public function getData()
    {
        return $this->getEntityData('Fullname');
    }

    /**
     * {@inheritdoc}
     * @param UserNamingType $entity
     */
    public function fillEntityData($key, $entity)
    {
        $entity->setTitle($key);
        $entity->setFormat('PREFIX FIRST MIDDLE LAST SUFFIX');
    }

    protected function createEntity($key)
    {
        $userNamingType = new UserNamingType();

        $reflectionClass = new \ReflectionClass(UserNamingType::class);
        $method = $reflectionClass->getProperty('id');
        $method->setAccessible(true);
        $method->setValue($userNamingType, 1);

        return $userNamingType;
    }
}