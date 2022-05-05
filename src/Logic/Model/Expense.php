<?php

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
}