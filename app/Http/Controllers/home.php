<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class home extends Controller
{
    //
    public function index()
    {
        $user = User::where('email', 'admin@gmail.com')->first();
        return response()->json($user);
        //return view('home');
    }
}
