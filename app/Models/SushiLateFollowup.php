<?php

namespace App\Models;

use App\Services\ReportService;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class SushiLateFollowup extends Model
{
    //
    use Sushi;

    public function getRows(): array
    {
        $rows = ReportService::getTodayAndLate();

        return $rows['late'];
    }
}
