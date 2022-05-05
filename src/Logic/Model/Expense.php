<?php

namespace src\Logic\Model;

final class Expense
{
    public function __construct(
        private readonly string $description,
        private string $tag,
        private readonly string $price,
    )
    {
    }
}