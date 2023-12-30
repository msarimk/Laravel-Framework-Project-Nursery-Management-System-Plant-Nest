<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Validator;

class ReviewController extends Controller
{
    public function plantReviews(REQUEST $request){

        $validator = Validator::make($request->all(),[
            'name'        => 'required',
            'email'       => 'required|email',
            'comments'     => 'required|max:225',
            'rating'     => 'required',
        ]);
        // dd($validator->fails());
        if($validator->fails()){
            // $errors = $validator->errors()->getMessages();
            return redirect()->back()->withErrors(['plantReview' => $validator->errors()->all()]);
        }

        Review::create([
            'name'      => $request->name,
            'plant_id'     => $request->plant_id,
            'email'     => $request->email,
            'comments'  => $request->comments,
            'rating'    => (int) $request->rating,
        ]);

        return redirect()->back();
    }

    public function toolReviews(REQUEST $request){

        $validator = Validator::make($request->all(),[
            'name'        => 'required',
            'email'       => 'required|email',
            'comments'     => 'required|max:225',
            'rating'     => 'required',
        ]);
        // dd($validator->fails());
        if($validator->fails()){
            // $errors = $validator->errors()->getMessages();
            return redirect()->back()->withErrors(['toolReview' => $validator->errors()->all()]);
        }

        Review::create([
            'name'      => $request->name,
            'tool_id'     => $request->tool_id,
            'email'     => $request->email,
            'comments'  => $request->comments,
            'rating'    => (int) $request->rating,
        ]);

        return redirect()->back();
    }
}
