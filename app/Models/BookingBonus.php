<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class BookingBonus extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function bonus()
    {
        return $this->belongsTo(Bonus::class);
    }
}
