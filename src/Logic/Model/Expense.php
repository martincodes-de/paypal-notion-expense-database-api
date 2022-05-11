<?php

declare(strict_types=1);

namespace src\Logic\Model;

final class Expense
{
    public function __construct(
        public readonly string $description,
        private string $category,
        public readonly string $price,
    )
    {
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }
}