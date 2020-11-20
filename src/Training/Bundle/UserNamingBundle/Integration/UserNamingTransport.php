<?php

namespace Training\Bundle\UserNamingBundle\Integration;

use Oro\Bundle\IntegrationBundle\Entity\Transport;
use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingSettings;
use Training\Bundle\UserNamingBundle\Form\Type\UserNamingSettingsType;

class UserNamingTransport implements TransportInterface
{
    public function init(Transport $transportEntity)
    {
    }

    public function getLabel()
    {
        return 'training.usernaming.settings.label';
    }

    public function getSettingsFormType()
    {
        return UserNamingSettingsType::class;
    }

    public function getSettingsEntityFQCN()
    {
        return UserNamingSettings::class;
    }
}