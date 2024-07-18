<?php

namespace App\Models\ActiveRecord;

use App\Interfaces\ActiveRecordExecuteInterface;
use App\Interfaces\ActiveRecordInterface;
use Exception;
use ReflectionClass;

abstract class ActiveRecord implements ActiveRecordInterface
{
    protected ?string $table = null;
    protected array $attributes = [];
    public function __construct()
    {
        if (!$this->table) {
            $this->table = strtolower((new ReflectionClass($this))->getShortName());
        }
    }

    /**
     * @throws Exception
     */
    public function __get(string $name): mixed
    {
        if (!$this->attributes[$name]) {
            throw new Exception("The attribute {$name} not exists");
        }

        return $this->attributes[$name];
    }

    public function __set(string $name, mixed $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function execute(ActiveRecordExecuteInterface $activeRecordExecuteInterface)
    {
        return $activeRecordExecuteInterface->execute($this);
    }
}