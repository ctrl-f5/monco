<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

spl_autoload_register(function ($name) {

    $dir = __DIR__.'/../';
    $include = function ($class, $dir) {
        $file =
            $dir.
            str_replace('\\', DIRECTORY_SEPARATOR, $class).
            '.php';
        if (file_exists($file)) {
            require_once $file;
            return true;
        }
        return false;
    };

    $map = array(
        'Monco\\Modeling' => $dir.'MoncoModeling/',
        'Monco\\Renderer' => $dir.'MoncoRenderer/',
        'Monco\\Cli' => $dir.'MoncoCli/',
        'Monco' => $dir.'MoncoSharedLib/',
    );
    foreach ($map as $namespace => $d) {
        if (strpos($name, $namespace) !== false) {
            if ($include(substr($name, strlen($namespace)+1), $d)) {
                return;
            }
        }
    }

    $includeDir = get_include_path();
    $includeDir = explode(PATH_SEPARATOR, $includeDir);
    foreach ($includeDir as $d) {
        $file = $d.DIRECTORY_SEPARATOR.str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $name).'.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
        $file = $d.DIRECTORY_SEPARATOR.str_replace(array('\\', '_'), DIRECTORY_SEPARATOR, $name).'.filter.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }

    }
});
