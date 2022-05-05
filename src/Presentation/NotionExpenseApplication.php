<?php

namespace src\Presentation;

use src\Persistence\ConfigurationDataSource;

final class NotionExpenseApplication
{
    public function __construct(
        private readonly ConfigurationDataSource $config = new ConfigurationDataSource()
    )
    {
    }

    public function run()
    {
        if (!$this->isNewDataSended()) {
            new JsonResponseOutput([
                "msg" => "No data sended.",
            ]);
        }
    }

    private function isNewDataSended()
    {
        return array_key_exists("newData", $_POST);
    }
}