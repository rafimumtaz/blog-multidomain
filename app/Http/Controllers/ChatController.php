<?php
namespace App\Http\Controllers;
use App\Events\NewChatMessage;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function index() { return view('chat'); }
    public function fetchMessages() { return ChatMessage::with('user.institution')->latest()->take(50)->get()->reverse()->values(); }
    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string|max:1000']);
        $message = Auth::user()->messages()->create(['message' => $request->input('message')]);
        broadcast(new NewChatMessage($message->load('user.institution')))->toOthers();
        return ['status' => 'Message Sent!'];
    }
}