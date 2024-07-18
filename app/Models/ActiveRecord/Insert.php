<?php

namespace App\Models\ActiveRecord;


use App\Interfaces\ActiveRecordExecuteInterface;
use App\Interfaces\ActiveRecordInterface;

class Insert extends Base implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "INSERT INTO {$activeRecordInterface->getTable()} (";
        $sql .= implode(',', array_keys($activeRecordInterface->getAttributes())) . ") VALUES (:";
        $sql .= implode(',:', array_keys($activeRecordInterface->getAttributes())) . ")";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($activeRecordInterface->getAttributes());
        return $prepare->rowCount();
    }
}
