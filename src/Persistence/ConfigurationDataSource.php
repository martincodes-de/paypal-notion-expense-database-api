<?php

namespace src\Persistence;

use Exception;
use src\Persistence\Exceptions\ConfigurationLoadingException;

final class ConfigurationDataSource
{
    private string $configurationUrl = __DIR__."/../../config.ini";
    private string $notionAppSecret;
    private string $notionDatabaseId;
    private string $apiPassword;

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
        $this->notionAppSecret = $configuration["notion_app_secret"];
        $this->notionDatabaseId = $configuration["notion_database_id"];
        $this->apiPassword = $configuration["api_password"];
    }

    /**
     * @return string
     */
    public function getNotionAppSecret(): string
    {
        return $this->notionAppSecret;
    }

    /**
     * @return string
     */
    public function getNotionDatabaseId(): string
    {
        return $this->notionDatabaseId;
    }

    public function getApiPassword()
    {
        return $this->apiPassword;
    }
}