<?php

namespace CooperativeComputingSMS\Http\Controller;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function SMSindex()
    {
        return view('cc-sms::index');
    }

    public function sendSMS(Request $request)
    {
        try {
            $sender = env('TWILIO_SENDER');
            $sid = env('TWILIO_ACCOUNT_SID');
            $authToken = env('TWILIO_AUTH_TOKEN');
            $twilio = new Client($sid, $authToken);
            $twilio->messages->create("+92".$request->sms_receiver, [
                    "body" => $request->sms_message,
                    "from" => $sender,
                    "mediaUrl" => ["https://demo.twilio.com/owl.png"]
                ]
            );
            return view('cc-sms::sms.welcome');
        }catch (Exception) {
            return 'Oops, SMS was not sent';
        }
    }
}
