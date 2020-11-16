<?php

namespace Training\Bundle\UserNamingBundle\EventListener;

use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Oro\Bundle\UserBundle\Entity\User;

class UserViewNamingListener
{
    public function onUserView(BeforeListRenderEvent $event)
    {
        /** @var User $user */
        $user = $event->getEntity();

        $template = $event->getEnvironment()->render(
            '@TrainingUserNaming/User/name_data.html.twig',
            ['entity' => $user]
        );
        $event->getScrollData()->addSubBlockData(0, 0, $template);
    }
}