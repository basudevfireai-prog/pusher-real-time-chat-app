<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $username;
    public $message;

    public function __construct($username, $message)
    {
        $this->username = $username;
        $this->message = $message;
    }

    /**
     * Kon channel-e broadcast hobe.
     */
    public function broadcastOn(): array
    {
        return [new Channel('chat-channel')];
    }

    /**
     * Event-er nam ki hobe (Frontend-e listen korar jonno).
     */
    public function broadcastAs()
    {
        return 'message-event';
    }
}
