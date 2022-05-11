<?php

declare(strict_types=1);

namespace src\Presentation;

final class JsonResponseOutput
{
    public function __construct(
        private array $outputJson,
    )
    {
        header('Content-type: application/json');
        echo json_encode($this->outputJson);
        die();
    }
}