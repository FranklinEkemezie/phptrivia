<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

abstract class BaseModel
{

    protected Database $db;

    public function __construct(
        private array $dbConfig
    )
    {
        $this->db = new Database($dbConfig);
    }

}