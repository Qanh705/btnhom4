<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        Message::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
