<?php

declare(strict_types=1);

function getClassPath(string $class, array $autoloadPaths): string {

    $classFile = str_replace(
        array_keys($autoloadPaths),
        array_values($autoloadPaths),
        $class
    );
    $classFile = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $classFile);

    return DOCUMENT_ROOT . $classFile . '.php';
}

function getAutoloadPaths(string $autoloadPathsFile): array|false {
    return getJSONFromFile($autoloadPathsFile);
}

spl_autoload_register(function (string $class) {

    $classPath = getClassPath($class, getAutoloadPaths(APP_ROOT . 'autoloads.json'));
    if (file_exists($classPath)) {
        include $classPath;
    }
});

