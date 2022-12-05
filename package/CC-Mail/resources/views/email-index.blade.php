<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template</title>
<style>
        body {
            background-color: whitesmoke;
        }
        
        /* The main body container */
        #main_form_container {
            display: grid;
            justify-content: center;
            border-radius: 5px;
            padding: 20px;
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
</style>
</head>
<body>
    <div id="main_form_container">
        <form action="{{ route('sendEmail') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            <div>
                <input type="submit" value="Send Email" id="send_email_btn">
            </div>
        </form>
    </div>
</body>

</html>