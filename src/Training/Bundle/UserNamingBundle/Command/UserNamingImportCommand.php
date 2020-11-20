<?php

namespace Training\Bundle\UserNamingBundle\Command;

use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingSettings;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingImportCommand extends Command
{
    /**
     * @var DoctrineHelper
     */
    private $doctrineHelper;

    public function __construct(
        DoctrineHelper $doctrineHelper,
        string $name = null
    ) {
        parent::__construct($name);
        $this->doctrineHelper = $doctrineHelper;
    }


    protected function configure()
    {
        $this->setName('training:usernaming:import')
            ->setDescription('Import all user naming from integrations');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $userNamingTypeAdded = false;
        $userNamingSettingsRepo = $this->doctrineHelper->getEntityRepository(UserNamingSettings::class);
        $userNamingRepo = $this->doctrineHelper->getEntityRepository(UserNamingType::class);
        $userNamingManager = $this->doctrineHelper->getEntityManager(UserNamingType::class);
        /** @var UserNamingSettings $item */
        foreach ($userNamingSettingsRepo->findAll() as $item) {
            if (!$item->getChannel()->isEnabled()) {
                continue;
            }
            $data = file_get_contents($item->getUrl());
            if (!$data) {
                $output->writeln('Can\'t get data from URL');
                continue;
            }
            $jsonData = json_decode($data, 1);
            if (!$jsonData) {
                $output->writeln('Not a valid json');
                continue;
            }
            foreach ($jsonData as $namingTypeData) {
                if (!array_key_exists('title', $namingTypeData) || !array_key_exists('format', $namingTypeData)) {
                    $output->writeln('Invalid naming type');
                    continue;
                }
                $userNaming = $userNamingRepo->findBy(['title' => $namingTypeData['title']]);
                if ($userNaming) {
                    $output->writeln('Existing user naming type: '. $namingTypeData['title']);
                    continue;
                }
                $userNaming = new UserNamingType();
                $userNaming->setTitle($namingTypeData['title'])
                    ->setFormat($namingTypeData['format']);
                $output->writeln('Add user naming type: '. $namingTypeData['title']);
                $userNamingManager->persist($userNaming);
                $userNamingTypeAdded = true;
            }
        }

        if ($userNamingTypeAdded) {
            $userNamingManager->flush();
        }

        $output->writeln('done.');
    }
}