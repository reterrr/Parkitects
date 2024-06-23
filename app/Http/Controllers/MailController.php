<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail()
    {
        $details = [
            'title' => 'Mail from Laravel',
            'body' => 'This is a test email sent from Laravel.'
        ];

        Mail::to('bmroczek@loken.pl')->send(new MyTestMail($details));

        return "Email Sent!";
    }
}
