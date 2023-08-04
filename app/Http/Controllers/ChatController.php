<?php

namespace App\Http\Controllers;

use App\Events\SendMessageToUserEvent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $listUser = User::all();

        return view('chat.index')->with([
            'listUser' => $listUser,
        ]);
    }

    public function send(Request $request, User $userInfo)
    {
        Log::debug("user to receive message: {$userInfo->id}");
        $message = $request->get('message');

        broadcast(new SendMessageToUserEvent($message, $userInfo));

        return response()->json(['code' => 200, 'message' => $message]);
    }
}
