<?php

use core\DB;

include('config/configuration.php');
include('config/params.php');
spl_autoload_register(function ($className) {
    $path = $className . '.php';
    if (file_exists($path))
        require $path;
});


$core = \core\Core::getInstance();
$core->initialize();
$core->run();
$core->done();

