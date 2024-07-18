<?php

namespace App\Models;

use App\Models\ActiveRecord\ActiveRecord;

class User extends ActiveRecord
{
    protected ?string $table = "users";
}
