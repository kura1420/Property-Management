<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function attachments()
    {
        return $this->hasMany(ReportAttachment::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productItem()
    {
        return $this->belongsTo(ProductItem::class)
            ->withDefault(['name' => '-']);
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
