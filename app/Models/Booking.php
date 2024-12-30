<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function attachments()
    {
        return $this->hasMany(BookingAttachment::class);
    }

    public function bonuses()
    {
        return $this->hasMany(BookingBonus::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productItem()
    {
        return $this->belongsTo(ProductItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
