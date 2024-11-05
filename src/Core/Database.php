<?php

declare(strict_types=1);

namespace App\Core;

use App\Exceptions\DBException;
use PDO;

class Database
{
    private static ?PDO $dbInstance = null;

    // Database tables to prevent going to the database each
    public array $tables;

    public function __construct(array $dbConfig)
    {
        self::setUpDBConn($dbConfig);

        $this->tables = $this->getTables();
    }

    private static function setUpDBConn(array $dbConfig): void
    {
        if (is_null(static::$dbInstance)) {
            $dsn = <<<DSN
            {$dbConfig['driver']}:
            host={$dbConfig['host']};
            dbname={$dbConfig['database']}
            DSN;
    
            static::$dbInstance = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
        }

    }

    // Proxy PDO DB method calls to PDO property
    public function __call(string $method, array $args): mixed
    {
        if (method_exists(static::$dbInstance, $method)) {
            return call_user_func_array([static::$dbInstance, $method], $args);
        }

        throw new DBException("Calling undefined method '$method' on object of class " . get_class(static::$dbInstance));

    }


    // Custom database methods
    private function getTables(): array
    {

        $conn = static::$dbInstance;
        $query = "SHOW TABLES";

        return (($conn->query($query))->fetchAll(PDO::FETCH_NUM))[0] ?? [];
    }

    public function select(): array
    {
        return [];
    }

    /**
     * Insert data into a table
     * 
     * @param string $table The table
     * @param array $data The column-value pair of data to insert
     * @throws \App\Exceptions\DBException
     * @return ?int Returns the unique ID of the inserted row if available, else NULL
     */
    public function insert(
        string $table,
        array $data
    ): ?int
    {
        if (! in_array($table, $this->tables))
        {
            throw new DBException("Table $table not found");
        }

        $conn = self::$dbInstance;

        $columnList = implode(", ", array_keys($data));
        $valueList = implode(", ", array_map(fn($v) => ":$v", array_keys($data)));

        $query = "INSERT INTO $table ($columnList) VALUES ($valueList)";

        $stmt = $conn->prepare($query);
        try {
            if (! $stmt->execute($data)) {
                throw new DBException("Something went wrong!");
            }
        } catch(\PDOException $e) {
            throw new DBException($e->getMessage(), (int) $e->getCode());
        }

        return ((int) $conn->lastInsertId()) ?: null;
    }
}