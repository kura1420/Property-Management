<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportService
{
    public static function getTodayAndLate(): array
    {
        $customers = DB::select("select 
            tb.id as typebyer_id,
            tb.name as role, 
            c.id as customer_id,
            c.fullname,
            c.handphone_1,
            c.handphone_2,
            coalesce((select cast(created_at as date) as x from reports where customer_id = c.id order by created_at desc), c.first_res_date) as last_follow
        from customers c 
        inner join type_buyers tb on c.type_buyer_id = tb.id");

        $followUpToday = [];
        $followUpLate = [];

        foreach ($customers as $customer) {
            $reminds = \App\Models\RemindBuyer::where('type_buyer_id', $customer->typebyer_id)->get();

            $followUpRoles = [];
            foreach ($reminds as $r) {
                if ($r->type == 'D') {
                    $followUpRoles[] = $r->remind;
                } else {
                    $followUpRoles[] = $r->remind > 1 ? $r->remind * 7 : 7;
                }
            }

            $lastFollowUp = Carbon::parse($customer->last_follow);
            $isFollowedUp = false;

            sort($followUpRoles);
            foreach ($followUpRoles as $role => $days) {
                $nextFollowUp = $lastFollowUp->copy()->addDays($days);

                if ($nextFollowUp->isToday()) {
                    $followUpToday[] = [
                        'customer_id' => $customer->customer_id,
                        'fullname' => $customer->fullname,
                        'handphone_1' => $customer->handphone_1,
                        'handphone_2' => $customer->handphone_2,
                        'role' => $customer->role,
                        'date' => $nextFollowUp->toDateString()
                    ];
                    $isFollowedUp = true;
                }
            }

            if (!$isFollowedUp) {
                $followUpLate[] = [
                    'customer_id' => $customer->customer_id,
                    'fullname' => $customer->fullname,
                    'handphone_1' => $customer->handphone_1,
                    'handphone_2' => $customer->handphone_2,
                    'role' => $customer->role,
                    'date' => $customer->last_follow
                ];
            }
        }

        return [
            'today' => $followUpToday,
            'late' => $followUpLate
        ];
    }
}
