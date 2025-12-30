<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index() {
        return view('chat');
    }

    public function sendMessage(Request $request) {
        $username = $request->username ?? 'Anonymous';
        $message = $request->message;

        // Event-ti broadcast kora
        broadcast(new MessageSent($username, $message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }
}
