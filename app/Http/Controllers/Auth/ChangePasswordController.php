<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function update(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'confirm_pass'=>'required|same:password'
        ]);

        $user = Auth::user();
        $match = Hash::check($request->current,$user->password);

        if (!$match){
            return redirect()->back()->withErrors('Current password is wrong!');
        }

        if ($request->new_pass != $request->confirm_pass){
            return redirect()->back()->withErrors('New password and confirm are not matched!');
        }
        $new_pass = Hash::make($request->new_pass);
        $user->password = $new_pass;
        $user->save();

        return redirect()->back()
            ->with('success', 'Password has been changed successfully');
    }
}
