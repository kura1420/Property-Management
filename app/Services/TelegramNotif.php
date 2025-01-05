<?php

namespace App\Services;

use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramNotif
{
    public static function todayFollowUp(): void
    {
        $buyers = ReportService::getTodayAndLate()['today'];

        $message = "Hai Tim,
            
Berikut daftar buyer yang harus di followup hari ini:
        
";

        foreach ($buyers as $key => $buyer) {
            $loop = $key + 1;

            $handphone_2 = $buyer['handphone_2'] ? '/ ' . $buyer['handphone_2'] : '';

            $message .= $loop . ". " . $buyer['fullname'] . " ( " . $buyer['handphone_1'] . $handphone_2 .  " )\n";
        }

        if (count($buyers) > 0) {
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHAT_TO'),
                'parse_mode' => 'markdown',
                'text' => $message
            ]);
        }
    }

    public static function lateFollow(): void
    {
        $buyers = \App\Services\ReportService::getTodayAndLate()['late'];

        $message = "Hai Tim,
            
Berikut daftar buyer yang belum di followup sampai hari ini:

";

        foreach ($buyers as $key => $bt) {
            $loop = $key + 1;

            $handphone_2 = $bt['handphone_2'] ? '/ ' . $bt['handphone_2'] : '';

            $message .= $loop . ". " . $bt['fullname'] . " ( " . $bt['handphone_1'] . $handphone_2 .  " ), last follow: " . $bt['date'] . "\n";
        }

        if (count($buyers) > 0) {
            Telegram::sendMessage([
                'chat_id' => env('TELEGRAM_CHAT_TO'),
                'parse_mode' => 'markdown',
                'text' => $message
            ]);
        }
    }
}
