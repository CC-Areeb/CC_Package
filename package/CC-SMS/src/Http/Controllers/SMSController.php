<?php

namespace CooperativeComputingSMS\Controllers;

use App\Http\Controllers\Controller;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class SMSController extends Controller
{
    public function SMSindex()
    {
        return view('sms-index');
    }

    public function sendSMS()
    {
        $otp = $this->generateOTP();

        $request = (object) [
            'sms_message' => 'Text message with OTP: '. $otp,
            'sms_receiver' => '<The registered phone number(s)>',
        ];

        try {
            $sid = config('sms.sid', 'some_sid');
            $sender = config('sms.sender', 'some_sender');
            $authToken = config('sms.auth', 'some_token');
            $twilio = new Client($sid, $authToken);
            $twilio->messages->create(
                $request->sms_receiver,
                [
                    "body" => $request->sms_message,
                    "from" => $sender,
                    "mediaUrl" => ["https://demo.twilio.com/owl.png"]
                ]
            );
            return 'SMS was sent';
        } catch (TwilioException $e) {
            throw $e;
        }
    }

    public function generateOTP()
    {
        return random_int(0,99999);
    }
}
