<?php

namespace App\Http\Controllers\Admin;

use App\Classes\HelperFunctions;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plant;
use App\Models\Category;
use Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class PlantController extends Controller
{
    public function index(){
        $plants = Plant::with('categories')->get();
        // dd($plants);
        foreach($plants as $key => $plant){
            $plant->number = $key + 1;
        }       
        return view('admin.plants.index',compact('plants'));
    }

    public function addingPlants(){
        $category = Category::where('sub_categories','plants')->get();
        return view('admin.plants.add-plants',compact('category'));
    }

    public function addPlants(REQUEST $request){
        $category = Category::where('sub_categories','plants')->get();
        $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'description'       => 'required',
            'price'             => 'required',
            'image'             => 'image|mimes:jpeg,png,jpg',
            'categories_id'     => 'required',
        ]);
        // dd($validator->fails());
        if($validator->fails()){
            $errors = $validator->errors()->getMessages();
            return view('admin.plants.add-plants',compact('category'))->withErrors($errors);
        }
        else{
            $plants = new PLant();
            if ($request->has('image')) {
                HelperFunctions::uploadPlantImage($request, $plants);
            }
            $plants->name = $request->name;
            $plants->description = $request->description;
            $plants->price = $request->price;
            $plants->categories_id = (int) $request->categories_id;
            $plants->save();
            
            return redirect()->route('plants',compact('category'));
        }
    }

    public function deletePlants($id){
        $plants = Plant::Find($id);
        if (File::exists(public_path($plants->image))) {
            File::delete(public_path($plants->image));
            // You might also want to remove the image_path from the database if needed
        }
        $plants->delete();
        return redirect()->route('plants');
    }

}
