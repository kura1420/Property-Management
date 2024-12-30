<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class TypeBuyer extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function reminds()
    {
        return $this->hasMany(RemindBuyer::class, 'type_buyer_id', 'id');
    }
}
