<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;
    public $role;
    public $permission;
    public $event;
    public $total_users;
    public $total_roles;
    public $total_permissions;

    const  ADDED    = 'Added';
    const  DELETED  = 'Deleted';
    const  BLOCKED  = 'Blocked';
    const  RESTORED = 'Restored';


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Object $object,$event=null)
    {
        //TODO: Fetch Total Stats
        //$condition=['type'=>null];
        // $this->total_users=\App\User::count();
        // $this->total_roles=\App\Role::where($condition)->count();
        // $this->total_permissions=\App\Permission::where($condition)->count();


        if ($object  instanceof \App\User) {

            $this->user=$object;
            $this->event=$event;


        }

        if ($object  instanceof \App\Role) {

            $this->role=$object;
            $this->event=$event;

        }

        if ($object  instanceof \App\Permission) {

            $this->permission=$object;
            $this->event=$event;

        }



    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new PricatChannel('doctor-update');
        return ['user-update'];
    }
}
