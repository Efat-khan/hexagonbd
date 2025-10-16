<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\LandingPage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $layout_data=LandingPage::first();
        $page_name = 'Contact Question';
        $contact = Contact::orderBy('read', 'ASC')->get();
        // dd($contact);
        return view('backEnd.contact.index',compact('contact','page_name','layout_data'));
    }
    public function edit($id){
        $layout_data=LandingPage::first();
        $page_name = 'Contact Question Edit';
        $contact = Contact::findOrFail($id);
        if($contact){
            return view('backEnd.contact.edit',compact('contact','layout_data','page_name'));
        }
        return view('backEnd.contact.index');
    }
    
    public function delete(Request $request)
    {
        $contact = Contact::findOrFail($request->id);

        // dd($user);
        if (empty($contact)) {

            return response()->json([
                'status' => false,
                'msg' => 'Contact did not removed.'
            ]);
        } else {
            $contact->delete();
            return response()->json([
                'status' => true,
                'msg' => 'Contact removed successfully.'
            ]);
        }
    }

    public function update(Request $request){
        // Validate member-specific data
        $contact = Contact::findOrFail($request->id);
        if ($contact){
            $validateData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email',
                'phone' => 'nullable',
                'read' => 'required',
                'status' => 'required',
                'message' => 'required',
            ]);
            // Create the member
            
    
            if ($contact->update($validateData)) {
                // If everything was successful
                session()->flash('success', [
                    'icon' => 'success',
                    'name' => 'Message updated successfully.',
                ]);
    
    
                return response()->json([
                    'status' => true,
                    'message' => 'Message updated successfully.',
                ]);
                
            }
        }else {
            session()->flash('error', [
                'icon' => 'error',
                'name' => "Don't updated message",
            ]);

            return response()->json([
                'status' => false,
                'message' => "Don't updated message.",
            ]);
        }
    }
}
