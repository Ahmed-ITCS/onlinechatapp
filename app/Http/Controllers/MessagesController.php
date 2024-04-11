<?php

namespace App\Http\Controllers;

use App\Models\messages;

use App\Models\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        session_start();
$token = $_SESSION['token'];
$currentUser = User::where('remember_token', $token)->first();
$userId = $request->query('user');
$messages = messages::orderBy('created_at', 'asc')
            ->where('receiver_id', $currentUser->id)
            ->where('sender_id', $userId)
            ->orWhere(function($query) use ($userId, $currentUser) {
                $query->where('receiver_id', $userId)
                      ->where('sender_id', $currentUser->id);
            })
            ->get();
return view('chatbox', compact('messages', 'userId'));

    }

    public function sendMessage(Request $request)
    {
        $otherUser = $request->query('userId');
        session_start();
        $token = $_SESSION['token'];
        $currentUser = User::where('remember_token', $token)->first();
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $message = new messages();
        $message->content = $request->input('message');

        // Set a default user ID or a placeholder value
        $message->sender_id = $currentUser->id; // Example: setting it as 'guest'
        $message->receiver_id= $otherUser;
        $message->save();

        return redirect()->route('chatbox')->with('success', 'Message sent successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(messages $messages)
    {
        //
    }
}
