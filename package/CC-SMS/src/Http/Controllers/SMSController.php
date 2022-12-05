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
        return view('cc-sms::smsIndex');
    }

    public function sendSMS(Request $request)
    {
        try {
            $sender = env('TWILIO_SENDER');
            $sid = env('TWILIO_ACCOUNT_SID');
            $authToken = env('TWILIO_AUTH_TOKEN');
            $twilio = new Client($sid, $authToken);
            $twilio->messages->create($request->sms_receiver, [
                    "body" => $request->sms_message,
                    "from" => $sender,
                    "mediaUrl" => ["https://demo.twilio.com/owl.png"]
                ]
            );
            return view('cc-sms::smsWelcome');
        }catch (TwilioException $e) {
            return 'Oops, SMS was not sent.';
        }
    }
}
