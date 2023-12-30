<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aboutus;

class AboutusController extends Controller
{
    public function index(){
        $aboutus = Aboutus::with('aboutusServices')->orderBy('id','ASC')->get();
        // dd($slider);
        // foreach($aboutus as $about){
        //     foreach($about->aboutusServices as $services){
        //         $about->services = $services->services;
        //         $about->animate_delay = $services->animate_delay;
        //     }
        // }
        return view('admin.aboutus.index',compact('aboutus'));
    }
}
