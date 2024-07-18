<?php

namespace App\Models\ActiveRecord;



use App\Interfaces\ActiveRecordExecuteInterface;
use App\Interfaces\ActiveRecordInterface;

class Delete extends Base implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "DELETE from {$activeRecordInterface->getTable()} WHERE id = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($activeRecordInterface->getAttributes());
        return $prepare->rowCount();
    }
}
