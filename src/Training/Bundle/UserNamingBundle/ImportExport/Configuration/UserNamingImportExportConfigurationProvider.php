<?php

namespace Training\Bundle\UserNamingBundle\ImportExport\Configuration;

use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfiguration;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationInterface;
use Oro\Bundle\ImportExportBundle\Configuration\ImportExportConfigurationProviderInterface;
use Training\Bundle\UserNamingBundle\Entity\UserNamingType;

class UserNamingImportExportConfigurationProvider implements ImportExportConfigurationProviderInterface
{

    public function get(): ImportExportConfigurationInterface
    {
        return new ImportExportConfiguration([
            ImportExportConfiguration::FIELD_ENTITY_CLASS => UserNamingType::class,
            ImportExportConfiguration::FIELD_EXPORT_PROCESSOR_ALIAS => 'training_usernaming',
            ImportExportConfiguration::FIELD_EXPORT_TEMPLATE_PROCESSOR_ALIAS => 'training_usernaming',
            ImportExportConfiguration::FIELD_IMPORT_PROCESSOR_ALIAS => 'training_usernaming.add_or_replace',
        ]);
    }
}