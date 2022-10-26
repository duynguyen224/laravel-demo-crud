<?php

namespace App\Console\Commands;

use App\Mail\GoodMorningMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class AutoGoodMorning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:goodmorning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for auto send email to good morning user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        // dd($user);
        if (count($users) > 0) {
            foreach ($users as $user) {
                Mail::to($user)->send(new GoodMorningMail($user));
                return Command::SUCCESS; // 0
            }
        }

        return Command::FAILURE; // 1
    }
}
