<?php

namespace src\Presentation;

use src\Logic\ExpenseConverter;
use src\Persistence\ConfigurationDataSource;

final class NotionExpenseApplication
{
    public function __construct(
        private readonly ConfigurationDataSource $config = new ConfigurationDataSource(),
        private readonly ExpenseConverter $converter = new ExpenseConverter(),
    )
    {
    }

    public function run(): void
    {
        if (!$this->areNewExpensesSent()) {
            new JsonResponseOutput([
                "msg" => "No expenses sent.",
            ]);
        }
    }

    private function areNewExpensesSent(): bool
    {
        return array_key_exists("expenses", $_POST);
    }
}