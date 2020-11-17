<?php

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\UserBundle\Entity\User;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class EntityNameProviderDecorator implements EntityNameProviderInterface
{
    /**
     * @var EntityNameProviderInterface
     */
    private $decoratedProvider;

    public function __construct(EntityNameProviderInterface $decoratedProvider)
    {
        $this->decoratedProvider = $decoratedProvider;
    }

    public function getName($format, $locale, $entity)
    {
        if (!$entity instanceof User || !$entity->getUserNaming()) {
            return $this->decoratedProvider->getName($format, $locale, $entity);
        }

        /** @var UserNamingType $userNamingType */
        $userNamingType = $entity->getUserNaming();

        return str_replace(
            ['FIRST', 'LAST', 'MIDDLE', 'PREFIX', 'SUFFIX'],
            [
                $entity->getFirstName(),
                $entity->getLastName(),
                $entity->getMiddleName(),
                $entity->getNamePrefix(),
                $entity->getNameSuffix(),
            ],
            mb_strtoupper($userNamingType->getFormat())
        );
    }

    public function getNameDQL($format, $locale, $className, $alias)
    {
        return $this->decoratedProvider->getNameDQL($format, $locale, $className, $alias);
    }
}