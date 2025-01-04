<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cmd';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $buyerToday = \App\Services\ReportService::getTodayAndLate()['late'];

        $message = "Hai Tim,
            
Berikut daftar buyer yang belum di followup sampai hari ini:

";

        foreach ($buyerToday as $key => $bt) {
            $loop = $key + 1;

            $handphone_2 = $bt['handphone_2'] ? '/ ' . $bt['handphone_2'] : '';

            $message .= $loop . ". " . $bt['fullname'] . " ( " . $bt['handphone_1'] . $handphone_2 .  " ), last follow: " . $bt['date'] . "\n";
        }

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHAT_TO'),
            'parse_mode' => 'markdown',
            'text' => $message
        ]);

        dump('OK');
    }
}
