<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassController extends Controller
{
    public function ChangePassword() {
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request) {
        $validateData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;

        if(Hash::check($request->old_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return Redirect()->route('login')->with('success', 'Password Is Changed Successfully.');
        } else {
            return Redirect()->back()->with('error', 'Current Password Is Invalid.');
        }
    }

    public function PUpdate() {
        if(Auth::user()) {
            $user = User::find(Auth::user()->id);
            if($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request) {
        $user = User::find(Auth::user()->id);
        if($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->save();
            // Notification
            $notification = array(
                'message' => 'User Profile Is Update Successfully.',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            return Redirect()->back();
        }
    }
}
