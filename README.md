
# Cooperative Computing Mailing and SMS template package

A basic template and implementation of the Laravel mailing and sms services.

**Minimum Laravel version support:** *laravel 7, laravel 8 and laravel 9*

### Installation command using composer
```
composer require cooperativecomputing/package
```

The environment variables are provided in a text file called **keys.txt** 

Use the @csrf keyword in your html form blade files as laravel uses it for protection against cross site request forgery and is a must before you send any requests from the forms.

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

***Mailgun***
\
`MAIL_MAILER=smtp`
\
`MAIL_HOST=smtp.mailgun.org`
\
`MAIL_PORT=587`
\
`MAIL_USERNAME=YOUR_USERNAME_FROM_MAILGUN`
\
`MAIL_PASSWORD=YOUR_PASSWORD_FROM_MAILGUN`
\
`MAIL_ENCRYPTION=tls`

***Mailtrap***
\
`MAIL_MAILER=smtp`
\
`MAIL_HOST=smtp.mailtrap.io`
\
`MAIL_PORT=2525`
\
`MAIL_USERNAME=YOUR_USERNAME_FROM_MAILTRAP`
\
`MAIL_PASSWORD=YOUR_PASSWORD_FROM_MAILTRAP`
\
`MAIL_ENCRYPTION=tls`

***Sendgrid***
\
`MAIL_MAILER=smtp`
\
`MAIL_HOST=smtp.sendgrid.net`
\
`MAIL_PORT=587`
\
`MAIL_USERNAME=apikey`
\
`MAIL_PASSWORD=sendgrid_api_key`
\
`MAIL_ENCRYPTION=tls`

***Twilio***
\
`TWILIO_ACCOUNT_SID=YOUR_TWILIO_SID_FROM_TWILIO`
\
`TWILIO_AUTH_TOKEN=YOUR_TWILIO_AUTH_TOKEN_FROM_TWILIO`
\
`TWILIO_SENDER=YOUR_TWILIO_PHONE_NUMBER_FROM_TWILIO (optional)`

## composer.json
Add these in your composer json file, inside autoload --> psr-4
```
"CooperativeComputing\\": "app/Http/Controllers/",
"CooperativeComputing\\Mail\\": "app/Mail/",
"CooperativeComputingSMS\\": "app/Http/Controllers/"
```
Next run the `composer du` command in the terminal.
## app.php
Add the service provider
```php
/*
* Package Service Providers...
*/

CooperativeComputing\EmailingServiceProvider::class,
CooperativeComputingSMS\SmsServiceProvider::class,
```
## Publish the SMS and Maling services

If by chance the auto-publish is not done then execute the below given command:
```
php artisan vendor:publish
```
+ After running the vendor publish command, you will be shown a series of publishable packages, you have to select the `Tag: CC-Emails` and `Tag: ccsms` type their key numbers from your list.
+ Once you have published, run your local development server and at the end of your URL type `\mail` for the mail form and `\sms` for the sms form.
+ You can also use the `--tag` flag to directly publish the packages as shown below:
```
php artisan vendor:publish --tag=CC-Emails
php artisan vendor:publish --tag=CC-SMS
```
The above commands will directly publish your respective packages.


For the Twilio template, I am using the form request method of Laravel as I cannot disclose my personal cell number.
```
php artisan install:email
php artisan install:sms
```

The above commands will install the files from the package folder into you main project files respectivly.



