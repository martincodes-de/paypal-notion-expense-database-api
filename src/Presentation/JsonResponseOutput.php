<?php

namespace src\Presentation;

class JsonResponseOutput
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