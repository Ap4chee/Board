<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Mail::raw($data['message'], function($m) use ($data) {
            $m->to(config('mail.from.address'))
              ->subject($data['subject']);
        });

        return redirect()->route('contact')
                         ->with('success', 'Your message has been sent.');
    }
}
