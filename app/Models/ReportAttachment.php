<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ReportAttachment extends Model
{
    //
    use HasUlids;

    public $incrementing = false;

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
