<?php

namespace Training\Bundle\UserNamingBundle\Provider;

use Oro\Bundle\UserBundle\Entity\User;

class UserNamingTypeProvider
{
    public function getName(User $user, $format)
    {
        return str_replace(
            ['FIRST', 'LAST', 'MIDDLE', 'PREFIX', 'SUFFIX'],
            [
                $user->getFirstName(),
                $user->getLastName(),
                $user->getMiddleName(),
                $user->getNamePrefix(),
                $user->getNameSuffix(),
            ],
            mb_strtoupper($format)
        );
    }

    public function getExampleName(string $format)
    {
        $user = new User();
        $user->setNamePrefix('Mr.')
            ->setFirstName('John')
            ->setMiddleName('Mid.')
            ->setLastName('Doe')
            ->setNameSuffix('Suf.');

        return $this->getName($user, $format);
    }
}