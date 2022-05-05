<?php

namespace src\Persistence;

use Exception;
use src\Persistence\Exceptions\ConfigurationLoadingException;

final class ConfigurationDataSource
{
    private string $configurationUrl = __DIR__."/../../config.ini";
    private string $notion_app_secret;
    private string $notion_database_id;

    public function __construct()
    {
        $configuration = $this->readConfiguration($this->configurationUrl);
        $this->setConfiguration($configuration);
    }

    /**
     * @throws Exception
     * @return array<String, String>
     */
    private function readConfiguration(string $configUrl): array
    {
        $configuration = parse_ini_file($configUrl);

        if ($configuration === false) {
            throw new ConfigurationLoadingException("Configuration.ini can't be loaded.");
        }

        return $configuration;
    }

    /**
     * @param array<String, String> $configuration
     * @return void
     */
    private function setConfiguration(array $configuration): void
    {
        $this->notion_app_secret = $configuration["notion_app_secret"];
        $this->notion_database_id = $configuration["notion_database_id"];
    }

    /**
     * @return string
     */
    public function getNotionAppSecret(): string
    {
        return $this->notion_app_secret;
    }

    /**
     * @return string
     */
    public function getNotionDatabaseId(): string
    {
        return $this->notion_database_id;
    }
}