<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    //
    use HasUlids;

    public $incrementing = false;
}
