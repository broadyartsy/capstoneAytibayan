<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserEvent;

class UpdateProgramBeneficiaryTotalsListener
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
    public function handle(UserEvent $event)
    {
        $user = $event->user;

        // Get the associated program for the user
        $program = $user->program;

        // Update the beneficiary totals based on user's status
        $program->total_active_beneficiaries = $program->user->where('status_id', '1')->count();
        $program->total_inactive_beneficiaries = $program->users->where('status_id', '2')->count();

        // Save the program to update the totals
        $program->save();
    }
}
