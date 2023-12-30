<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PLant;
use App\Models\User;
use App\Models\Cart;
use App\Models\CompanyDetail;

class HomeController extends Controller
{
    public function index(){
        return redirect('home');
    }

    public function home(){
        $new_arrivals = Plant::limit(4)->orderBy('id','DESC')->get();
        return view('web.index',compact('new_arrivals'));
    }

    // public function getCompany(){
    //     $company = CompanyDetail::get();
    //     dd($company);
    // }

}
