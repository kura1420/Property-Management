<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function items()
    {
        return $this->hasMany(ProductItem::class);
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    public function attachments()
    {
        return $this->hasMany(ProductAttachment::class);
    }
}
