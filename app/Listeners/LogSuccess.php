<?php

namespace App\Listeners;

use App\Models\Action;
use App\Models\Welcome;
use Illuminate\Auth\Events\Login;

class LogSuccess
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $welcome = Welcome::create([
            'activity' => 'login',
        ]);

        $welcome->logs()->create([
            'user_id' => $event->user->id,
            'action_id' => Action::where('action_name', 'login')->first()->id,
            'log_message' => 'Ingresó al sistema',
        ]);
    }
}
