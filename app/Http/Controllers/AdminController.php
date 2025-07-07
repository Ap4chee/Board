<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdminController extends Controller
{
    public function ads(Request $request){
        if (! $request->session()->get('is_admin', false)) {
            return redirect()->route('login');
        }
        
        $ads = Ad::with('user')->latest()->get();
        return view('admin', compact('ads'));   
    }

    public function destroy($id){
    $ad = \App\Models\Ad::findOrFail($id);

    $ad->delete();
    session()->flash('success', 'Ad #' . $id . ' has been deleted.');
    return redirect()->route('admin.ads');
}

}
