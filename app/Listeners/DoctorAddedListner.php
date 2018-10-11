<?php

namespace App\Listeners;

use App\Events\DoctorAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DoctorAddedListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DoctorAdded  $event
     * @return void
     */
    public function handle(DoctorAdded $event)
    {
        //
    }
}
