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


    // Error codes
    public const ERROR_DUPLICATE_ENTRY = 23000;


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
    
            $dbInstance = new PDO($dsn, $dbConfig['user'], $dbConfig['password']);
            $dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbInstance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $dbInstance->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            static::$dbInstance = $dbInstance;
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

    private function tableExists(string $table, $throwError=false): bool
    {
        $tableExists = in_array($table, $this->tables);

        if ($throwError && ! $tableExists) 
            throw new DBException("Table '$table' not found");

        return $tableExists;
    }

    /**
     * Select data from table
     * @return array
     */
    public function select(
        string $table,
        array $data
    ): ?array
    {
        $this->tableExists($table, true);

        $conn = self::$dbInstance;

        // Retrieve necessary data
        $password = $data['password'] ?? null;  // Get the password if given
        $data = array_filter($data, function($value, $field) {
            return $field !== 'password';   // ignore the password
        }, ARRAY_FILTER_USE_BOTH);
        $conditions = join(", ", array_map(fn($v) => "$v = :$v", array_keys($data)));

        $query = <<<SQL
        SELECT uid, username, email, password, experience_level
        FROM users
        WHERE $conditions
        SQL;

        $stmt = $conn->prepare($query);
        try {
            if (! $stmt->execute($data)) {
                throw new DBException("Something went wrong!");
            }

            // Get the user with the given details 
            if (! ($userSelectInfo = $stmt->fetch())) {
                return null;
            }

            // Verify if the password match
            $isUser = password_verify($password, $userSelectInfo['password']);

            return $isUser ? $userSelectInfo : null;
        } catch(\PDOException $e) {
            throw new DBException($e->getMessage(), (int) $e->getCode());
        }
    }

    /**
     * Insert data into a table
     * 
     * @param string $table The table
     * @param array $data The column-value pair of data to insert
     * @throws \App\Exceptions\DBException
     * @return ?int Returns the unique ID of the inserted row if available, else NULL.
     * Returns FALSE if the user has been registered before.
     */
    public function insert(
        string $table,
        array $data
    ): int|null|false
    {
        $this->tableExists($table, true);

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
            //  Duplicate entry issue
            if ((int) $e->getCode() === self::ERROR_DUPLICATE_ENTRY)
                return false;

            throw new DBException($e->getMessage(), (int) $e->getCode());
        }

        return ((int) $conn->lastInsertId()) ?: null;
    }
}