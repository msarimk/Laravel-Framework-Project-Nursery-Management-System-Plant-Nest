<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\Tool;
use App\Models\Cart;
use App\Models\Review;
use Carbon\Carbon;


class ShopController extends Controller
{
    public function index(){
        $plants = Plant::with('categories')->get();
        // dd($plants);
        return view('web.shop',compact('plants'));
    }

    public function plantDetails($id){
        // dd($id);
        $recent = Plant::limit(4)->orderBy('id','DESC')->get();
        $recent_reviews = Review::where('plant_id',$id)->limit(5)->with('plants')->orderBy('id','DESC')->get();
        $reviews_count = Review::where('plant_id',$id)->count();
        foreach($recent_reviews as $reviews){
            $reviews->posted_date = Carbon::parse($reviews->created_at)->format('Y-m-d');
        }
        // dd($recent_review);
        $shop = Plant::with('categories')->Find($id);
        // dd($shop);
        return view('web.shop-details',compact('shop','recent','recent_reviews','reviews_count'));

    }

    public function cart(){
        $carts = Cart::where('user_id',auth()->user()->id)->where(function ($query) {
                        $query->whereNotNull('plant_id')->orWhereNotNull('tool_id');
                    })->with('plants', 'users', 'tools')->get();
        // dd($carts);
        return view('web.cart',compact('carts'));
    }

    public function tools(){
        $tools = Tool::with('categories')->get();
        // dd($plants);
        return view('web.tools',compact('tools'));
    }

    public function toolDetails($id){

        $recent = Tool::limit(4)->orderBy('id','DESC')->get();
        $recent_reviews = Review::where('tool_id',$id)->limit(5)->with('tools')->orderBy('id','DESC')->get();
        $reviews_count = Review::where('tool_id',$id)->count();
        foreach($recent_reviews as $reviews){
            $reviews->posted_date = Carbon::parse($reviews->created_at)->format('Y-m-d');
        }
        // dd($recent);
        $tool = Tool::with('categories')->Find($id);
        // dd($shop);
        return view('web.tool-details',compact('tool','recent','recent_reviews','reviews_count'));
    }

}
