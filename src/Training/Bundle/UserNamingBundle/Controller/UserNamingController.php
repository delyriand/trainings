<?php

namespace Training\Bundle\UserNamingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingController
{
    /**
     * @Route("/", name="training_usernaming_list")
     *
     * @Template
     */
    public function indexAction()
    {
        return [
            'entity_class' => UserNamingType::class
        ];
    }

    /**
     * @Route("/view/{id}", name="training_usernaming_view", requirements={"id"="\d+"})
     * @Template
     *
     * @param UserNamingType $user
     * @return array
     */
    public function viewAction(UserNamingType $user)
    {
        return [
            'entity'        => $user,
        ];
    }
}