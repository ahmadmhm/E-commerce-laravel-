<?php

namespace App\Events;

use App\Order;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class newUserRequestOrder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user , $order;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId , $orderId)
    {
        $this->user = User::where('id',$userId)->with('Information')->first();
        $this->order = Order::where('id',$orderId)->with('Products')->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
