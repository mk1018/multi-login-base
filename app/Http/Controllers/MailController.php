<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Mail as SendMail;

class MailController extends Controller
{
    public function index()
    {
        \Mail::to('test@example.com')->send(new SendMail());
    }
}
