<?php

namespace App\Models\ActiveRecord;


use App\Interfaces\ActiveRecordExecuteInterface;
use App\Interfaces\ActiveRecordInterface;

class FindAll extends Base implements ActiveRecordExecuteInterface
{
    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        $filter = !empty($activeRecordInterface->getAttributes()) ? ' WHERE ' : null;
        $sql = "SELECT * FROM {$activeRecordInterface->getTable()} {$filter}";
        foreach ($activeRecordInterface->getAttributes() as $name => $value) {
            $sql .= "{$name} = :{$name} AND ";
        }
        $sql = rtrim($sql, ' AND ');
        $prepare = $this->pdo->prepare($sql);
        $prepare->execute(
            !empty($activeRecordInterface->getAttributes()) ? $activeRecordInterface->getAttributes() : []
        );
        return $prepare->fetchAll();
    }
}
