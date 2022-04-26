<?php

namespace App\Services;

use App\Interfaces\EmailInterface;
use Illuminate\Support\Facades\Mail;

class EmailService implements EmailInterface{
    public function sendEmail($email, $mailer, $data)
    {
        Mail::to($email)->send(new $mailer($data));
    }
}
