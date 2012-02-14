<?php

spl_autoload_register(function ($name) {

    $dir = __DIR__.'/../';
    $include = function ($class, $dir) {
        $file =
            $dir.
            str_replace('\\', '/', $class).
            '.php';
        if (file_exists($file)) require_once $file;
    };

    $map = array(
        'Monco\\Config' => $dir.'MoncoConfig/',
        'Monco\\Modeling' => $dir.'MoncoModeling/',
        'Monco\\Renderer' => $dir.'MoncoRenderer/',
        'Monco\\SharedLib' => $dir.'SharedLib/',
        'Monco\\Cli' => $dir.'MoncoCli/',
    );
    foreach ($map as $namespace => $d) {
        if (strpos($name, $namespace) !== false) {
            $include(substr($name, strlen($namespace)+1), $d);
        }
    }
});