<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class MailController extends Controller
{
    //
    public function sendEmail()
    {
        // dd(env('MAIL_PORT'),env('MAIL_HOST'));
        $details = [
            'title' => 'Mail from test',
            'body' => 'This is for testing mail using gmail',
        ];
        Mail::to("richardtohon@gmail.com")->send(new Testmail($details));
        return dd("Email send");
        // $email_to = "richardtohon@gmail.com";
        // Mail::send('emails.TestMail', ['reponse' => $details], function($message) use($email_to) {
        //     $message->to($email_to, '')->subject('Login Security Number');
        //     $message->from('giwudev@gmail.com','xxxxxxxxxxx');
        //  });
    }
}
