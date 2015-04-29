<?php
    spl_autoload_register(function($fullQualifiedClassName) {
        $namespace = strtok($fullQualifiedClassName, '\\');
        if (strcmp($namespace, "framework") == 0) {
            $className = strtok('\\');
            require_once(dirname(__FILE__) . "/$className.php");
        }
    });