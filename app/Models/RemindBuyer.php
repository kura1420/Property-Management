<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class RemindBuyer extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    protected function remindHPlus(): Attribute
    {
        return Attribute::make(
            get: fn(mixed $value, array $attr) => 'H+' . $attr['remind'],
        );
    }

    public function type()
    {
        return $this->belongsTo(TypeBuyer::class);
    }
}
