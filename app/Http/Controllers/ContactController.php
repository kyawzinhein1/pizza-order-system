<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // admin contact view page
    public function AdminContactPage(){
        $contacts = Contact::paginate(3);
        return view('admin.contact.contactList',compact('contacts'));
    }

    // user contact page
    public function userContactPage(){
        return view('user.contact.contactPage');
    }

    // get user contact
    public function userContactInfo(Request $request){
        $data = $this->requestContactData($request);
        Contact::create($data);
        return redirect()->route('user#contactPage')->with(['contactSuccess'=>'Contact Message Send...']);
    }

    // request contact data
    private function requestContactData($request){
        return[
            'name' => $request->name ,
            'email' => $request->email ,
            'message' => $request->message
        ];
    }
}
