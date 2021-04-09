<?php

namespace SawanMahajan\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SawanMahajan\Contact\Mail\ContactMailer;
use SawanMahajan\Contact\Models\Contact;

class ContactController extends Controller
{
    public function index(){
        return view('contact::contact');
    }

    public function send(Request $request){
        $contact = new Contact();
        $contact->message = $request->txtMessage;
        $contact->email = $request->txtEmail;
        $contact->name = $request->txtName;
        $contact->save();

        Mail::to(config('contact.send_email_to'))->send(new ContactMailer($request->txtMessage, $request->txtName));
        return redirect(route('contact'))->with(['message' => 'Thank you, your mail has been sent successfully.']);;
    }
}
