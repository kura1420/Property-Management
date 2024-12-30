<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class BookingAttachment extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
