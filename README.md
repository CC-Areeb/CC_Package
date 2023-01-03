
# Cooperative Computing Mailing and SMS templates

A basic template and implementation of the Laravel mailing and sms services.

**Minimum Laravel version support:** *laravel 7, laravel 8 and laravel 9*

### Installation command using composer
```
composer require cooperativecomputing/mailing-and-sms-template
```

The environment variables are provided in a text file called **keys.txt** 

Use the @csrf keyword in your html form blade files as laravel uses it for protection against cross site request forgery and is a must before you send any requests from the forms.


## app.php
Add the service provider
```
/*
* Package Service Providers...
*/

CooperativeComputing\Services\EmailingServiceProvider::class,
CooperativeComputingSMS\Services\SmsServiceProvider::class,
```
## Publish the SMS and Maling services
```
php artisan vendor:publish --tag=CC-Emails
php artisan vendor:publish --tag=CC-SMS
```

## composer.json
For mailing template add these in your composer json file, inside `autoload` --> `psr-4`
```
"CooperativeComputing\\Routes\\": "routes/",
"CooperativeComputing\\Controllers\\": "app/Http/Controllers/",
"CooperativeComputing\\Mail\\": "app/Mail/",
```

For sms template add these in your composer json file, inside `autoload` --> `psr-4`
```
"CooperativeComputingSMS\\Routes\\": "routes/",
"CooperativeComputingSMS\\Controllers\\": "app/Http/Controllers/"
```

Run the `composer du` command in the terminal.

Next execute the commands below

```
php artisan install:email
php artisan install:sms
```
The above commands will install the files from the package folder into you main project files respectivly.

---
# Sending Mails
Add the environment variables in your `.env` file

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=YOUR_USERNAME_FROM_MAILTRAP
MAIL_PASSWORD=YOUR_PASSWORD_FROM_MAILTRAP
MAIL_ENCRYPTION=tls
```


### Send to a single user
```
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
```

### Send to a multiple users
```
public function sendEmail()
{
    $validator = [
        'sender' => 'sender@mail.com',
        'to' => ['receiver_one@mail.com', 'receiver_two@mail.com', 'receiver_three@mail.com'],
        'subject' => 'some subject',
        'message' => 'A message from sender',
    ];
    Mail::queue((new MailEmails($validator))->onQueue('emails'));
    return "mail has been sent";
}
```
---
# Mailable file


### Sending a mail
```
public $validator;

/**
    * Create a new message instance.
    *
    * @return void
    */

public function __construct($validator)
{
    $this->validator = $validator;
}

/**
    * Build the message.
    *
    * @return $this
    */

public function build()
{
    return $this->from($this->validator['sender'])
                ->subject($this->validator['subject'])
                ->to($this->validator['to'])
                ->markdown('email-welcome');
}
```
### Sending a single attachment  
```
public function build()
{
    return $this->from($this->validator['sender'])
                ->subject($this->validator['subject'])
                ->to($this->validator['to'])
                ->attach(public_path('<single attachment>'))
                ->markdown('email-welcome');
}
```

### Sending multiple attachments
```
public function sendEmail()
    {
        $attachments = [
            public_path('<attachment 1>'),
            public_path('<attachment 2>'),
            public_path('<attachment 3>'),
        ];
        $validator = [
            'sender' => 'sender@mail.com',
            'to' => 'receiver@mail.com',
            'subject' => 'some subject',
            'message' => 'A message from sender',
            'attachments' => $attachments
        ];
        Mail::queue((new MailEmails($validator))->onQueue('emails'));
        return "mail has been sent";
    }
```
Inside the Emails file
```
public function build()
{
    $this->from($this->validator['sender'])
        ->subject($this->validator['subject'])
        ->to($this->validator['to'])
        ->markdown('email-welcome');
    foreach ($this->validator['attachments'] as $attachment) {
        $this->attach($attachment);
    }
    return $this;
}
```

Add more options in your mail

```
return $this->from($this->validator['sender'])
            ->subject($this->validator['subject'])
            ->to($this->validator['to'])
            ->cc($this->validator['people'])
            ->bcc($this->validator['private_people'])
            ->attach(base_path('<path of any file>'))
            ->markdown('email-welcome');
```

| options | description |
| ------ | ------ |
| from | person who is sending the mail |
| subject | purpose of the email |
| to | the main recipient |
| cc | carbon copy for adding people publicly |
| bcc | blind carbon copy for adding people privatly |


# Sending SMS
Add the environment variables in your `.env` file

```
TWILIO_ACCOUNT_SID=YOUR_TWILIO_SID_FROM_TWILIO
TWILIO_AUTH_TOKEN=YOUR_TWILIO_AUTH_TOKEN_FROM_TWILIO
TWILIO_SENDER=YOUR_TWILIO_PHONE_NUMBER_FROM_TWILIO
```
For the Twilio template, I am using the form request method of Laravel as I cannot disclose my personal cell number.

*Note*

**To actually send an sms after resigistering your number, make sure to use the country code like for example in Pakistan we use `+92` otherwise the twilio cannot send sms.** 

Sms controller
```
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
```

`messages->create()` this is a method by twilio for creating the sms and sending it.

First argument takes in the recipient's cell number and the second argument is the main sms itself.

+ `body` this is the main body of your sms or the text you write to send
+ `from` this is the sender of the sms, for twilio you have to register your number
+ `mediaUrl` this is an optional field, we can send some media URLs with this

| options | description |
| ------ | ------ |
| body | this is the main body of your sms or the text you write to send |
| from | this is the sender of the sms, for twilio you have to register your number |
| mediaUrl | this is an optional field, we can send some media URLs with this |

More twilio examples with laravel

**https://www.twilio.com/blog/create-sms-portal-laravel-php-twilio**
