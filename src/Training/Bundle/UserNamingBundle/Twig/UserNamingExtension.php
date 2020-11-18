<?php


namespace Training\Bundle\UserNamingBundle\Twig;


use Oro\Bundle\UserBundle\Entity\User;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Training\Bundle\UserNamingBundle\Provider\EntityNameProviderDecorator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UserNamingExtension extends AbstractExtension
{
    /**
     * @var EntityNameProviderDecorator
     */
    private $nameProvider;

    public function __construct(EntityNameProviderDecorator $nameProvider)
    {
        $this->nameProvider = $nameProvider;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('name_example', [$this, 'getNameExample']),
        ];
    }

    public function getNameExample($format)
    {
        $namingType = new UserNamingType();
        $namingType->setFormat($format);

        $user = new User();
        $user->setNamePrefix('Mr.')
            ->setFirstName('John')
            ->setMiddleName('Mid.')
            ->setLastName('Doe')
            ->setNameSuffix('Suf.');
        $user->setUserNaming($namingType);

        return $this->nameProvider->getName($format, null, $user);
    }
}