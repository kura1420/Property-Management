<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
