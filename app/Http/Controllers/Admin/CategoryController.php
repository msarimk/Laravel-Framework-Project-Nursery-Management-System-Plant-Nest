<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.plants.categories',compact('categories'));
    }

    public function editPageCategory($id){
        $categories = Category::Find($id);
        return view('admin.plants.edit-categories',compact('categories'));
    }

    public function addingCategories(){
        return view('admin.plants.add-categories');
    }

    public function addCategories(REQUEST $request){
        $validator = Validator::make($request->all(),[
            'categories'     => 'required',
        ]);
        // dd($validator->fails());
        if($validator->fails()){
            $errors = $validator->errors()->getMessages();
            return view('admin.plants.add-categories')->withErrors($errors);
        }
        else{
            Category::create([
                'categories' => $request->categories,
            ]);

            return redirect()->route('categories');
        }
    }

    public function editCategories(REQUEST $request){
        
        
            Category::where('id','=',$request->id)->update([
                // 'id' => (int)$request->id,
                'categories' => $request->categories,
            ]);

            return redirect()->route('categories');
        
    }
}
