<?php
//spl_autoload_register(function ($className) {
//    $file = $className . '.php';
//    if (file_exists($file)) {
//        include $file;
//    } else {
//        throw new Exception("Unable to load $className.");
//    }
//});
//?>

<?php

spl_autoload_register(function ($class) {
    // Convert the namespace to a file path
    $file = str_replace('\\', '/', $class) . '.php';

    // Check if the file exists and require it
    if (file_exists($file)) {
        require_once $file;
    }
});
?>