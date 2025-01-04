<?php

namespace App\Console\Commands;

use App\Services\TelegramNotif;
use Illuminate\Console\Command;

class NotifFollowupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:followup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command notif followup from telegram to group agency';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        TelegramNotif::todayFollowUp();
        TelegramNotif::lateFollow();
    }
}
