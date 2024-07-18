<?php

namespace App\Interfaces;

interface ActiveRecordInterface
{
    public function execute(ActiveRecordExecuteInterface $activeRecordExecuteInterface);
}
