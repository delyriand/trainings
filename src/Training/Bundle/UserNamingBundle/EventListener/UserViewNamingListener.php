<?php

namespace Training\Bundle\UserNamingBundle\EventListener;

use Oro\Bundle\UIBundle\Event\BeforeListRenderEvent;
use Oro\Bundle\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserViewNamingListener
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function onUserView(BeforeListRenderEvent $event)
    {
        if (!$this->authorizationChecker->isGranted('training_usernaming_info')) {
            return;
        }

        /** @var User $user */
        $user = $event->getEntity();

        $template = $event->getEnvironment()->render(
            '@TrainingUserNaming/User/name_data.html.twig',
            ['entity' => $user]
        );
        $event->getScrollData()->addSubBlockData(0, 0, $template);
    }
}