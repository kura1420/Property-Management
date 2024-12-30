<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function bookings()
    {
        return $this->hasMany(BookingBonus::class);
    }
}
