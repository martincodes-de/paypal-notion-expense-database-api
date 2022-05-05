<?php

namespace src\Presentation;

final class NotionExpenseApplication
{
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