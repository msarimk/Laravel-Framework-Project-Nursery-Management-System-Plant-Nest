<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_admin','0')->get();
        foreach($users as $user){
            $user->joining_date = Carbon::parse($user->created_at)->format('Y-m-d');
        }
        return view('admin.users.index',compact('users'));
    }

    public function deleteUsers($id){

        $orders = Order::where('user_id', $id)->get();

        foreach ($orders as $order) {
            $order->delete();
        }

        $users = User::Find($id);
        $users->delete();

        return redirect()->route('users');
    }
}
