<?php

use src\Presentation\NotionExpenseApplication;

require_once __DIR__."/../vendor/autoload.php";

(function() {
    $app = new NotionExpenseApplication();
    $app->run();
})();