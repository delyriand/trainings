<?php

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\EntityBundle\Provider\EntityNameProviderInterface;
use Oro\Bundle\LocaleBundle\Model\FullNameInterface;

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
        if (!$entity instanceof FullNameInterface) {
            return $this->decoratedProvider->getName($format, $locale, $entity);
        }

        return $entity->getLastName(). ' ' . $entity->getFirstName(). ' ' . $entity->getMiddleName();
    }

    public function getNameDQL($format, $locale, $className, $alias)
    {
        return $this->decoratedProvider->getNameDQL($format, $locale, $className, $alias);
    }
}