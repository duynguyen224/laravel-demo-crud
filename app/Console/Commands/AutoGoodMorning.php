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
        $userId = 6; // hard code 6

        $user = User::find($userId)->first();
        // dd($user);
        if ($user != null) {
            Mail::to($user)->send(new GoodMorningMail($user));
            return Command::SUCCESS; // 0
        }
        return Command::FAILURE; // 1
    }
}
