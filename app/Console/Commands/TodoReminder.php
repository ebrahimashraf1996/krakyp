<?php

namespace App\Console\Commands;

use App\Mail\NewOrder;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TodoReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        $currentDateTime = \Carbon\Carbon::now()->addHours(2);
//        $newDateTime = \Carbon\Carbon::now()->addHours(2)->addMinutes(60);
//
//        $clients = \App\Models\Client::with('user', 'cat')->active()->where('next_follow', '!=', null )->whereBetween('next_follow', [$currentDateTime, $newDateTime])->get();
//
//        foreach($clients as $client) {
//            $user = \App\Models\User::select('id', 'bullet')->find($client->user_id);
//            $user->notify((new \App\Notifications\ReminderFollowup("You Have a Follow up With " . $client->name . ' Today at: ' . \Carbon\Carbon::parse($client->next_follow)->format('g:i A'))));
//        }
        $user = \App\Models\User::select('id', 'email')->find(2);
        Mail::to($user->email)->send(new NewOrder());
//        $user->notify((new \App\Notifications\ReminderFollowup("You Have a Follow up With " . 'test' . ' Today at: ' )));
    }
}
