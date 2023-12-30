<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

class ServicesController extends Controller
{
    public function index(){
        $services = Service::with('servicesCategories')->orderBy('id','ASC')->get();
        // dd($slider);
        return view('admin.services.index',compact('services'));
    }
}
