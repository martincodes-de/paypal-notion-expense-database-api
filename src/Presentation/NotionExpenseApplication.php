<?php

declare(strict_types=1);

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
        $apiPasswordFromIncomingRequest = $_GET["api_password"] ?? null;
        $incomingRequestBody = json_decode(file_get_contents("php://input"));
        $rawExpenses = $incomingRequestBody->expenses ?? null;

        if (!$this->isRequestAuthenticated($apiPasswordFromIncomingRequest)) {
            new JsonResponseOutput([
                "status" => "error",
                "msg" => "Not authenticated.",
            ]);
        }

        if (!$this->areExpensesSent($rawExpenses)) {
            new JsonResponseOutput([
                "status" => "error",
                "msg" => "No expenses sent.",
            ]);
        }

        $expenses = $this->converter->convertToExpenses($rawExpenses);

        new JsonResponseOutput([
            "raw" => $incomingRequestBody->expenses,
            "converted" => $expenses
        ]);
    }

    private function areExpensesSent(?array $expenses): bool
    {
        if (is_null($expenses) || count($expenses) < 1) {
            return false;
        }

        return true;
    }

    private function isRequestAuthenticated(?string $apiPassword): bool
    {
        if ($apiPassword !== $this->config->getApiPassword()) {
            return false;
        }

        return true;
    }
}