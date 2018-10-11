<?php

namespace App\Events;

use App\Doctor;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DoctorEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $doctor;
    public $event;
    public $total_doctors;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Doctor $doctor,$event=null)
    {

        $this->doctor=$doctor;
        $this->event=$event;
        $this->total_doctors=Doctor::count();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new Channel('doctor-update');
        return ['doctor-update'];
    }
}
