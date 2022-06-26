<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class FrontendController extends Controller
{
    function welcome(){
        return view('welcome');
    }
    function about(){
        return view('about');
    }
    function contact(){
        $contacts_all_user = Contact::count();
        $contacts = Contact::paginate(5);
        $deleted_items = Contact::onlyTrashed()->get();
        return view('contact', compact('contacts','contacts_all_user','deleted_items'));
    }
    function contactinsert(Request $request){
        $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'age' => 'required',
            'email' => 'required',

        ]);
       Contact::insert([
           'name' => $request->name,
           'phone_number' => $request->phone_number,
           'age' => $request->age,
           'email' => $request->email,
            'created_at' => Carbon::now(),
       ]);
       return back()->with('info success', 'Your informations added successfully!!');
    }
    function contactdelete($id){

        if($id == 'all'){
            Contact::where('deleted_at' , NULL)->delete();
        }else{
            Contact::find($id)->delete();
        }
        return back()->with('info delete', 'Your informations Remove successfully!!');
     }
     function contactrestore($id){

        Contact::onlyTrashed()->where('id', $id)->restore();
        return back();
     }

     function contactdelete_all($id){
            Contact::onlyTrashed()->forceDelete();
            return back();
    }
    function contacteditpost(Request $request , $id){
        Contact::find($id)->update([
            'name' => $request->name,
           'phone_number' => $request->phone_number,
           'age' => $request->age,
           'email' => $request->email
        ]);
        return back();
    }
}
