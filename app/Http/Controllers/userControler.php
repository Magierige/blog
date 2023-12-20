<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Actions\Fortify\CreateNewUser;


class userControler extends Controller
{
    public function firstResult($email){
       return User::where('email', $email)->first();
    }
}
