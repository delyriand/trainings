<?php

namespace Training\Bundle\UserNamingBundle\Integration;

use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

class UserNamingChannel implements ChannelInterface, IconAwareIntegrationInterface
{

    public function getLabel()
    {
        return 'training.usernaming_channel.label';
    }

    public function getIcon()
    {
        return 'bundles/trainingusernaming/img/usernaming.png';
    }
}