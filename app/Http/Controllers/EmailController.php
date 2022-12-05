<?php

namespace CooperativeComputing\Http\Controllers;

use App\Http\Controllers\Controller;
use CooperativeComputing\Mail\Emails as MailEmails;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('cc-email::email-index');
    }

    public function sendEmail()
    {
        $attachments = [
            public_path('/images/1.jpg'),
            public_path('/images/2.jpg'),
            public_path('/images/3.jpg'),
        ];
        
        
        $validator = [
            'sender' => 'sender@mail.com',
            'to' => 'receiver@mail.com',
            'subject' => 'some subject',
            'message' => 'A message from sender',
            'attachment' => $attachments
        ];
        dd($validator);
        Mail::queue((new MailEmails($validator))->onQueue('emails'));
        return "mail has been sent";
    }
}