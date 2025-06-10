<?php
namespace App\Events;
use App\Models\ChatMessage;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class NewChatMessage implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;
    public ChatMessage $message;
    public function __construct(ChatMessage $message) { $this->message = $message; }
    public function broadcastOn(): array { return [ new PresenceChannel('chatroom') ]; }
}