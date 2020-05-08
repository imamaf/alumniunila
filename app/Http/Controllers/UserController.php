<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updatePassword(Request $request){
        if (!(Hash::check($request->get('old_password'), Auth::user()->password))) {
            // The passwords not matches
            //return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
            return redirect('/dashboard')->with('error' , 'Password gagal di update karena password lama tidak sesuai');
        }
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
       
        $user->save();
        return redirect('/dashboard')->with('status' , 'Password berhasil di update');
    }
    //
    //
}
