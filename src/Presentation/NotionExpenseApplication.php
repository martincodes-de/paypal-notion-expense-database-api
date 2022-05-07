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
        $incomingRequestBody = json_decode(file_get_contents("php://input"));
        $rawExpenses = $incomingRequestBody->expenses ?? null;

        if (!$this->areExpensesSent($rawExpenses)) {
            new JsonResponseOutput([
                "msg" => "No expenses sent.",
            ]);
        }

        new JsonResponseOutput([
            "data" => $incomingRequestBody->expenses,
        ]);
    }

    private function areExpensesSent(?array $expenses): bool
    {
        if (is_null($expenses) || count($expenses) < 1) {
            return false;
        }

        return true;
    }
}