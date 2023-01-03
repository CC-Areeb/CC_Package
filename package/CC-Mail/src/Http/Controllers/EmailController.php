<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Emails as MailEmails;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('email-index');
    }

    public function sendEmail()
    {
        $validator = [
            'sender' => 'sender@mail.com',
            'to' => 'receiver@mail.com',
            'subject' => 'some subject',
            'message' => 'A message from sender',
        ];
        Mail::queue((new MailEmails($validator))->onQueue('emails'));
        return "mail has been sent";
    }
}
