<?php

namespace Training\Bundle\UserNamingBundle\Api\Processor\Get;

use Oro\Bundle\UserBundle\Entity\User;
use Oro\Component\ChainProcessor\ContextInterface;
use Oro\Component\ChainProcessor\ProcessorInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Training\Bundle\UserNamingBundle\Provider\EntityNameProviderDecorator;

class AppendExampleNaming implements ProcessorInterface
{
    /**
     * @var EntityNameProviderDecorator
     */
    private $nameProviderDecorator;

    public function __construct(EntityNameProviderDecorator $nameProviderDecorator)
    {
        $this->nameProviderDecorator = $nameProviderDecorator;
    }

    public function process(ContextInterface $context)
    {
        $result = $context->getResult();
        if (!is_array($result)) {
            return;
        }

        $namingType = new UserNamingType();
        $namingType->setFormat($result['format']);

        $user = new User();
        $user->setNamePrefix('Mr.')
            ->setFirstName('John')
            ->setMiddleName('Mid.')
            ->setLastName('Doe')
            ->setNameSuffix('Suf.');
        $user->setUserNaming($namingType);

        $result['example'] = $this->nameProviderDecorator->getName($result['format'], null, $user);
        $context->setResult($result);
    }
}