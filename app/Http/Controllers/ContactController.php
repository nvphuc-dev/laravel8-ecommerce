<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\ContactForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function AdminContact() {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

    public function AdminAddContact() {
        return view('admin.contact.create');
    }

    public function AdminStoreContact(Request $request) {
        Contact::insert([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => Carbon::now(),
        ]);
        // Notification
        $notification = array(
            'message' => 'Contact Inserted Successfully.',
            'alert-type' => 'info'
        );
        return Redirect()->route('admin.contact')->with($notification);
    }

    public function EditContact($id) {
        $contacts = Contact::find($id);
        return view('admin.contact.edit', compact('contacts'));
    }

    public function UpdateContact(Request $request, $id) {
        $update = Contact::find($id)->update([
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ]);
        // Notification
        $notification = array(
            'message' => 'Contact Updated Successfully.',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.contact')->with($notification);
    }

    public function DeleteContact($id) {
        $delete = Contact::find($id)->delete();
        // Notification
        $notification = array(
            'message' => 'Contact Deleted Successfully.',
            'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
    }

    public function Contact() {
        $contacts = DB::table('contacts')->first();
        return view('pages.contact', compact('contacts'));
    }

    public function ContactForm(Request $request) {
        ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('contact')->with('success', 'Your Message Send Successfully.');
    }

    public function AdminMessage() {
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }

    public function ViewMsgContact($id) {
        $viewmsg = ContactForm::find($id);
        return view('admin.contact.viewmsg', compact('viewmsg'));
    }

    public function DeleteMessage($id) {
        $delete = ContactForm::find($id)->delete();
        // Notification
        $notification = array(
            'message' => 'Contact Message Deleted Successfully.',
            'alert-type' => 'error'
        );
        return Redirect()->route('admin.message')->with($notification);
    }
}
