<?php

namespace src\Persistence;

use Exception;
use src\Persistence\Exceptions\ConfigurationLoadingException;

final class ConfigurationDataSource
{
    private string $configurationUrl = __DIR__."/../../config.ini";
    private string $notion_app_secret;
    private string $database_id;

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
        $this->database_id = $configuration["database_id"];
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
    public function getDatabaseId(): string
    {
        return $this->database_id;
    }
}