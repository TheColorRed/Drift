<?php

// Prepare variables
$root = $argv[1];
$file = $argv[1] . "/" . $argv[2];

// Check to see if the file exists
if(!is_file($file)){
    echo "Could not find file: '$root'\n";
    exit;
}

chdir($argv[1]);

spl_autoload_register(function($class){
    $class = str_replace("\\", "/", $class);
    require_once __DIR__ . "/{$class}.php";
});

require __DIR__ . "/Drift/Core/functions.php";
require_once $file;
