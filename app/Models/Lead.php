<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
