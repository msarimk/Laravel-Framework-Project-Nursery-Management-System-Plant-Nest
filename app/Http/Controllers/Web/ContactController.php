<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\CompanyDetail;
use Validator;

class ContactController extends Controller
{
    public function index(){
        $company = CompanyDetail::get();
        // dd($company);
        return view('web.contact',compact('company'));
    }

    public function postContact(REQUEST $request){

        $contact = new Contact();

        $validator = Validator::make($request->all(),[
            'name'        => 'required',
            'email'       => 'required|email',
            'subject'     => 'required',
            'message'     => 'required',
        ]);
        // dd($validator->fails());
        if($validator->fails()){
            $errors = $validator->errors()->getMessages();
            return redirect()->back()->withErrors($errors);
        }
        else{
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();

            return redirect()->back();
        }
        
        
    }

}
