<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdminController extends Controller
{
    public function ads(Request $request)
    {
        if (! $request->session()->get('is_admin', false)) {
            return redirect()->route('en.login');
        }
        
        $ads = Ad::with('user')->latest()->get();
        return view('admin', compact('ads'));   
    }
}
