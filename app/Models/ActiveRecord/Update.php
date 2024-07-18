<?php

namespace App\Models\ActiveRecord;


use App\Interfaces\ActiveRecordExecuteInterface;
use App\Interfaces\ActiveRecordInterface;

class Update extends Base implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "UPDATE {$activeRecordInterface->getTable()} SET ";
        foreach ($activeRecordInterface->getAttributes() as $name => $value) {
            $sql .= "{$name} = :{$name}, ";
        }
        $sql = rtrim($sql, ', ');
        $sql .= " WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($activeRecordInterface->getAttributes());
        return $prepare->rowCount();
    }
}
