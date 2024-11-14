<?php
//ContactFormController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;

class ContactFormController extends Controller
{
    function post_message(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',      
            'title' => 'required',
            'message' => 'required'
        ]);

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email, //fetch data from url
            'title' => $request->title,
            'message' => $request->message
        ];

        try {
            Mail::to('kevinanatta@gmail.com')->send(new ContactFormMail($data)); //send mail
            Log::info('Email sent successfully');
            return back()->with('msg', 'Thanks for reaching out. Your message has been sent');
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return back()->with('error', 'Sorry, there was an error sending your message. Please try again later.');
        }
    }

    function form_view(){
        return view('contact');
    }
}
