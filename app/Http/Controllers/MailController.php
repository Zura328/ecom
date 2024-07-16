<?php

namespace App\Http\Controllers;

use App\Mail\SurveyMail;
use Illuminate\Http\Request;
use App\Mail\TestMail;
use App\Mail\TestMailing;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {
        Mail::to('andrei@gmail.com')->send(new TestMailing());
    }
}