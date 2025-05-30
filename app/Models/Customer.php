<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function typeBuyer()
    {
        return $this->belongsTo(TypeBuyer::class)
            ->withDefault(['name' => '???']);
    }
}
