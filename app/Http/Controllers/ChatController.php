<?php

namespace App\Http\Controllers;

use App\Events\MessageSend;
use App\Models\Message;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{
    public function index(ModelsRequest $req)
    {
        Gate::authorize('message', $req);
        $messages = $req->messages->load('user');
        return view('chat', compact(['messages', 'req']));
    }

    public function store(ModelsRequest $req, Request $request)
    {
        Gate::authorize('message', $req);

        $message = new Message($request->all());
        $message->messageable_type = 'App\Models\Request';
        $message->user_id = Auth::id();
        $message->save();
        // イベントを発火します
        event(new MessageSend($message));
        return response()->json(['message' => '投稿しました。']);
    }

    public function destroy(ModelsRequest $req, Message $message)
    {
        Gate::authorize('message', $req);
        $message->delete();
        return response()->json(['message' => '投稿しました']);
    }
}
