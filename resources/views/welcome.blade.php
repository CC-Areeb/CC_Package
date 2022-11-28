<?php

namespace CooperativeComputing\Http\Controllers;

use App\Http\Controllers\Controller;
use CooperativeComputing\Mail\Emails as MailEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        return view('cc-email::index');
    }

    public function sendEmail(Request $request)
    {
        $validator = [
            'sender' => 'required',
            'to' => 'required',
            'subject' => '',
            'message' => '',
        ];
        Mail::queue((new MailEmails($validator))->onQueue('emails'));
        return "mail has been sent";
    }
}
