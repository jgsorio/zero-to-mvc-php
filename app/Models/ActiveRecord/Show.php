<?php

namespace App\Models\ActiveRecord;


use App\Interfaces\ActiveRecordExecuteInterface;
use App\Interfaces\ActiveRecordInterface;

class Show extends Base implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        $sql = "SELECT * FROM {$activeRecordInterface->getTable()} WHERE `id` = :id";
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute($activeRecordInterface->getAttributes());
        return $prepare->fetch();
    }
}
