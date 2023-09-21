<?php

namespace App\Http\Controllers;

use App\Mail\test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class mailController extends Controller
{
    //
    public function index()

    {

        $mailData = [

            'title' => 'Mail from local test',

            'body' => 'This is for testing email using smtp.'

        ];

         

        Mail::to('test@gmail.com')->send(new test($mailData));

           

        dd("Email is sent successfully.");

    }
}
