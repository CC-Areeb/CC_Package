<?php

namespace CooperativeComputingSMS\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function SMSindex()
    {
        return view('sms-index');
    }

    public function sendSMS(Request $request)
    {
        try {
            $sid = config('sms.sid', 'some_sid');
            $sender = config('sms.sender', 'some_sender');
            $authToken = config('sms.auth', 'some_token');
            $twilio = new Client($sid, $authToken);
            $twilio->messages->create($request->sms_receiver, [
                    "body" => $request->sms_message,
                    "from" => $sender,
                    "mediaUrl" => ["https://demo.twilio.com/owl.png"]
                ]
            );
            return view('sms-welcome');
        }catch (TwilioException $e) {
            return 'Oops, SMS was not sent.';
        }
    }
}
