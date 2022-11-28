<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
    {{-- some basic styles --}}

<style>
        body {
            background-color: white;
        }

        /* The main body container */
        #main_form_container {
            display: grid;
            justify-content: center;
            border-radius: 5px;
            padding: 20px;
            background-color: whitesmoke;
        }


        /* sms and email buttons */
        #sms_send_btn,
        #send_email_btn {
            width: 100%;
            font-size: large;
            background-color: #3852a0;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 30px;
            font-family: sans-serif;
        }

        /* sms and email buttons */
        #sms_send_btn:hover,
        #send_email_btn:hover {
            transition: 0.2s;
            background-color: forestgreen;
        }

        /* all input fields */
        #sms_receiver,
        #sender,
        #to,
        #subject,
        #sms_message,
        #message {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 20px;
            font-family: sans-serif;
        }

        #go_back_link {
            text-decoration: none;
            width: 100%;
            font-size: large;
            background-color: #3852a0;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            font-size: 30px;
            font-family: sans-serif;
        }

        /* All labels */
        .base_label {
            font-size: 20px;
            font-family: sans-serif;
        }
</style>
</head>


<body>
    <div id="main_form_container">
        <h1 id="sms_welcome_heading">You sms was sent successfully</h1>
        <a href="{{ route('SMSindex') }}" id="go_back_link">
            Back
        </a>
    </div>
</body>

</html>