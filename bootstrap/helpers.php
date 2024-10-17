<?php

declare(strict_types=1);

function prettyPrint(mixed $value): void {
    echo '<pre>';
    var_dump($value);
    echo '<pre>';
}

function getJSONFromFile(string $jsonFile): mixed {
    if ( file_exists($jsonFile) &&
        pathinfo($jsonFile)['extension'] === 'json'
    ) {
        return json_decode(
            file_get_contents($jsonFile),
            true
        );
    }

    return false;
}