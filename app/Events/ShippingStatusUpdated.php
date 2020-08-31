<?php

namespace App\Events;

use Illuminate\Support\Arr;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ShippingStatusUpdated implements ShouldBroadcast
{
    use  Dispatchable,InteractsWithSockets,SerializesModels;

    public $broadcastQueue = 'redis';

    /**
     * 有关更新的信息。
     * @var string
     */
    public $message;
    /**
     * Create a new event instance.
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * 指定广播数据。
     * @return array
     */
    public function broadcastWith()
    {
        // 返回当前时间
        return ['message' => $this->message];
    }

    /**
     * 获取事件应该广播的频道。
     * @return array
     */
    public function broadcastOn()
    {
        return new Channel('test');
    }
}
