<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function userProfile($id){
        $users = User::Find($id);
        // dd($users);
            $users->joining_date = Carbon::parse($users->created_at)->format('Y-m-d');
            // dd($user->joining_date);
        return view('web.user-profile',compact('users'));
    }

    public function editProfile(REQUEST $request){
        // dd($request->password);
        $users = User::Find($request->id);
        if($request->password === null){
            $users->name = $request->name;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->save();
        }
        else{
            $users->name = $request->name;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->password = Hash::make($request->password);
            $users->save();
        }
            

        return redirect()->back();
    }
}
