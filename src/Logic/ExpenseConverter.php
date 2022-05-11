<?php

namespace src\Logic;

use src\Logic\Model\Expense;
use stdClass;

final class ExpenseConverter
{
    /**
     * @param stdClass[] $rawExpenses
     * @return Expense[]
     */
    public function convertToExpenses(array $rawExpenses): array
    {
        $convertedExpenses = [];

        foreach ($rawExpenses as $rawExpense) {
            $rawExpense = (array)$rawExpense;
            if ($this->isConvertable($rawExpense)) {
                $convertedExpenses[] = $this->convertSingleToExpense($rawExpense);
            }
        }

        return $convertedExpenses;
    }

    private function convertSingleToExpense(array $rawExpense): Expense
    {
        return new Expense($rawExpense["description"], "undefined", $rawExpense["price"]);
    }

    private function isConvertable(array $rawExpense): bool
    {
        if (array_key_exists("description", $rawExpense)
            && array_key_exists("price", $rawExpense)
            && array_key_exists("notice", $rawExpense)
        ) {
            return true;
        }

        return false;
    }
}