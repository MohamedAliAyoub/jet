<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddHoursCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:hours';

    protected $description = 'Add 90 hours to users on February 1st';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Check if today is February 1st
        if (Carbon::now()->month === 2 && Carbon::now()->day === 1) {
            // Add 90 hours to all users
            User::query()->increment('hours', 90);

            $this->info('Added 90 hours to all users.');
        } else {
            $this->info('Today is not February 1st. No hours were added.');
        }
    }
}
