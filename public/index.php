<?php

declare(strict_types=1);

use src\Presentation\NotionExpenseApplication;

require_once __DIR__."/../vendor/autoload.php";

(function() {
    $app = new NotionExpenseApplication();
    $app->run();
})();