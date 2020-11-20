<?php


namespace Training\Bundle\UserNamingBundle\EventListener;


use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Oro\Component\MessageQueue\Client\MessageProducerInterface;
use Psr\Log\LoggerInterface;
use Training\Bundle\UserNamingBundle\Async\Topics;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var MessageProducerInterface
     */
    private $messageProducer;

    public function __construct(LoggerInterface $logger, MessageProducerInterface $messageProducer)
    {
        $this->logger = $logger;
        $this->messageProducer = $messageProducer;
    }

    public function postPersist(UserNamingType $userNaming, LifecycleEventArgs $event)
    {
        // post because need an id
        $this->sendMessage($userNaming);
    }

    public function preUpdate(UserNamingType $userNaming, PreUpdateEventArgs $event)
    {
        if ($event->hasChangedField('format')) {
            $this->sendMessage($userNaming);
        }
    }

    private function sendMessage(UserNamingType $userNaming)
    {
        $this->logger->debug('MALEC : send message for '.$userNaming->getId());
        $this->messageProducer->send(Topics::USER_NAMING_EXAMPLE, ['id' => $userNaming->getId()]);
    }
}