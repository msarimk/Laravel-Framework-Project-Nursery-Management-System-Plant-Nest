<?php

namespace App\Http\Controllers\Admin;

use App\Classes\HelperFunctions;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Tool;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    public function index(){
        $tools = Tool::with('categories')->get();
        // dd($tools);
        return view('admin.tools.index',compact('tools'));
    }

    public function addingTools(){
        $category = Category::where('sub_categories','tools')->get();
        return view('admin.tools.add-tools',compact('category'));
    }

    public function addTools(REQUEST $request){
        $category = Category::where('sub_categories','tools')->get();
        $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'description'       => 'required',
            'price'             => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg',
            'categories_id'     => 'required',
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->getMessages();
            return view('admin.tools.add-tools',compact('category'))->withErrors($errors);
        }
        else{
            $tools = new Tool();
            if ($request->has('image')) {
                HelperFunctions::uploadToolImage($request, $tools);
            }
            $tools->name = $request->name;
            $tools->description = $request->description;
            $tools->price = $request->price;
            $tools->categories_id = (int) $request->categories_id;
            $tools->save();
            
            return redirect()->route('tools',compact('category'));
        }
    }

    public function deleteTools($id){
        $tools = Tool::Find($id);
        if (File::exists(public_path($tools->image))) {
            File::delete(public_path($tools->image));
            // You might also want to remove the image_path from the database if needed
        }
        $tools->delete();
        return redirect()->route('tools');
    }

}
