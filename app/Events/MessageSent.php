<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $roomId;
    public function __construct($message,$room_Id)
    {
        $this->message = $message;
        $this->roomId= $room_Id;
    }

    public function broadcastOn()
    {
        return ['channel-'. $this->roomId];
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

}
