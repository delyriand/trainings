<?php

namespace Training\Bundle\UserNamingBundle\Controller;

use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
use Oro\Bundle\SecurityBundle\Annotation\Acl;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Routing\Annotation\Route;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingController
{
    /**
     * @Route("/", name="training_usernaming_list")
     * @Template
     * @AclAncestor("training_usernaming_view")
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
     * @Acl(
     *      id="training_usernaming_view",
     *      type="entity",
     *      class="TrainingUserNamingBundle:UserNamingType",
     *      permission="VIEW"
     * )
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