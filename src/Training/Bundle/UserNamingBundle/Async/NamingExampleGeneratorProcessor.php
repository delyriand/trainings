<?php

namespace Training\Bundle\UserNamingBundle\Async;

use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Oro\Component\MessageQueue\Client\TopicSubscriberInterface;
use Oro\Component\MessageQueue\Consumption\MessageProcessorInterface;
use Oro\Component\MessageQueue\Transport\MessageInterface;
use Oro\Component\MessageQueue\Transport\SessionInterface;
use Oro\Component\MessageQueue\Util\JSON;
use Psr\Log\LoggerInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;
use Training\Bundle\UserNamingBundle\Provider\UserNamingTypeProvider;

class NamingExampleGeneratorProcessor implements MessageProcessorInterface, TopicSubscriberInterface
{
    /**
     * @var DoctrineHelper
     */
    private $doctrineHelper;
    /**
     * @var UserNamingTypeProvider
     */
    private $namingTypeProvider;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        DoctrineHelper $doctrineHelper,
        UserNamingTypeProvider $namingTypeProvider,
        LoggerInterface $logger
    ) {
        $this->doctrineHelper = $doctrineHelper;
        $this->namingTypeProvider = $namingTypeProvider;
        $this->logger = $logger;
    }

    public function process(MessageInterface $message, SessionInterface $session)
    {
        $body = JSON::decode($message->getBody());
        if (empty($body['id'])) {
            return self::REJECT;
        }

        /** @var UserNamingType|null $userNaming */
        $userNaming = $this->doctrineHelper->getEntity(UserNamingType::class, $body['id']);
        if (!$userNaming) {
            return self::REJECT;
        }
        $example = $this->namingTypeProvider->getExampleName($userNaming->getFormat());
        $this->logger->debug('MALEC : '.$example);
        $userNaming->setExample($example);
        $this->doctrineHelper->getEntityManager(UserNamingType::class)->flush();

        return self::ACK;
    }

    public static function getSubscribedTopics()
    {
        return [Topics::USER_NAMING_EXAMPLE];
    }
}