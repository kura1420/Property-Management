<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class RemindBuyer extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function type()
    {
        return $this->belongsTo(TypeBuyer::class);
    }
}
