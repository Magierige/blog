<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;

class userControler extends Controller
{
    public function firstResult($email)
    {
        return User::where('email', $email)->first();
    }

    public function isAdmin()
    {
        $id = Auth::id();
        $usr = DB::table('user_rights')
            ->where('user_id', $id)->get('right_id');
        $check = false;
        foreach ($usr as $u) {
            $rid = $u->right_id;
            if ($rid == 1) {
                $check = true;
                break;
            }
        }
        return $check;
    }

    public function findName($id)
    {
        return User::where('id', $id)->first('name');
    }

    public function catRight()
    {
        $id = Auth::id();
        $usr = DB::table('user_rights')
            ->where('user_id', $id)->get('right_id');
        $check = false;
        foreach ($usr as $u) {
            $rid = $u->right_id;
            if ($rid == 1 || $this->isAdmin()) {
                $check = true;
                break;
            }
        }
        return $check;
    }

    public function blogRight()
    {
        $id = Auth::id();
        $usr = DB::table('user_rights')
            ->where('user_id', $id)->get('right_id');
        $check = false;
        foreach ($usr as $u) {
            $rid = $u->right_id;
            if ($rid == 3 || $this->isAdmin()) {
                $check = true;
                break;
            }
        }
        return $check;
    }
}
