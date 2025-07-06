<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Ad::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/en/dashboard');
    }

    public function index()
    {
        $ads = Ad::with('user')->latest()->get();

        return view('en.dashboard', compact('ads'));
    }

    public function destroy($id)
{
    $ad = Ad::findOrFail($id);

    if ($ad->user_id !== Auth::id()) {
        abort(403); 
    }

    $ad->delete();

    return redirect()->route('en.dashboard')->with('success', 'Ad deleted successfully.');
}

}
