<?php

namespace App\Models\ActiveRecord;

use App\Models\Connection\Connection;
use PDO;

abstract class Base
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
    }
}