<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class tokenController extends Controller
{
    public function tokenSearch($token, $user, $api){
        $token = DB::table('personal_access_tokens')->where([
                ['name', '=', $token],
                ['tokenable_id', '=' , $user],
            ])->first();
            if (! $token || ! Hash::check($api, $token->token)) {
                $send = ['error' => 'token is niet correct'];
            }else{
                $send = ['succes' => true];
            }
            return $send;
    }

    public function deleteToken($device, $user){
        $del = DB::table('personal_access_tokens')->where([
                ['name', '=', $device],
                ['tokenable_id', '=' , $user],
            ])->delete();

            return true;
    }
}
