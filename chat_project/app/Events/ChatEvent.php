<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $user;
    public $time;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, User $user, $time)
    {
        $this->message = $message;
        $this->user = $user->name;
        $this->time = $time;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('my_chat_channel');
    }


    // Not even implement this method if you don't know exactly what you want with it !!
    /*public function broadcastAs()
    {
        return 'ChatEvent';
    }*/

}
